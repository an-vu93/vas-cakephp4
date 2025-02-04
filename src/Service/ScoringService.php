<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query\SelectQuery;
use Cake\I18n\FrozenTime;

class ScoringService
{
    private const CHUNK_SIZE = 1000; 

    private $indicators;
    private $customerMetrics;
    private $customerScores;
    
    public function __construct()
    {
        $this->indicatorsTable = TableRegistry::getTableLocator()->get('Indicators');
        $this->customerMetricsTable = TableRegistry::getTableLocator()->get('CustomerMetrics');
        $this->customerScoresTable = TableRegistry::getTableLocator()->get('CustomerScores');
    }

    /**
     * Get the metric data of a given indicator for constructing distribution graph
     *
     * @param int $indicatorId
     * @return array
     */
    public function getGraphData($indicatorId): array
    {
        // Get the indicator configuration
        $indicator = $this->indicatorsTable->get($indicatorId);
        
        // The query field now contains the metric calculation configuration
        // Example: {"metric": "license_count", "type": "direct"}
        // or: {"metric": "order_span", "type": "date_diff", "from": "first_order_date", "to": "last_order_date"}
        $config = json_decode($indicator->query, true);
        
        if (!$config || !isset($config['metric'])) {
            throw new \RuntimeException('Invalid indicator configuration');
        }

        $histogram = [];

        $query = $this->buildMetricQuery($this->customerMetricsTable, $config);
 
        $results = $query->disableHydration()->all()->toArray();
        $metricsValues = array_column($results, 'metric');

        // Count occurrences of each metric value
        $occurences = array_count_values($metricsValues);
        if (empty($occurences)) {
            throw new \RuntimeException('No scores found for this indicator');
        }
        ksort($occurences);
      
        $chartData = [
            'metric_values' => array_keys($occurences), 
            'occurences' => array_values($occurences), 
        ];

        return $chartData;
    }

    /**
     * Calculate percentiles for a given indicator
     *
     * @param int $indicatorId
     * @return array
     */
    public function getPercentiles($indicatorId): array
    {
        // Get the indicator configuration
        $indicator = $this->indicatorsTable->get($indicatorId);
        
        // The query field now contains the metric calculation configuration
        // Example: {"metric": "license_count", "type": "direct"}
        // or: {"metric": "order_span", "type": "date_diff", "from": "first_order_date", "to": "last_order_date"}
        $config = json_decode($indicator->query, true);
        
        if (!$config || !isset($config['metric'])) {
            throw new \RuntimeException('Invalid indicator configuration');
        }

        $percentiles = $this->calculateDistributionThresholds($this->customerMetricsTable, $config);

        return $percentiles;
    }

    /**
     * Update scores for a specific indicator across all customers
     */
    public function updateScorePerIndicator($indicatorId): bool
    {   
        $indicator = $this->indicatorsTable->get($indicatorId);
        
        // Process customers in chunks
        $page = 1;
        do {
            $customerIds = $this->customerMetricsTable->find()
                ->select(['customer_id'])
                ->limit(self::CHUNK_SIZE)
                ->page($page)
                ->all()
                ->extract('customer_id')
                ->toArray();
                
            if (empty($customerIds)) {
                break;
            }
            
            $this->updateScores($customerIds, [$indicator]);
            $page++;
            
        } while (true);
        
        return true;
    }

    /**
     * Update all indicator scores for a specific customer
     */
    public function updateScoresPerCustomer($customerId): bool
    {
        $activeIndicators = $this->indicatorsTable->find()
            ->where(['active' => 1])
            ->all();
            
        return $this->updateScores([$customerId], $activeIndicators);
    }

    private function updateScores(array $customerIds, $indicators): bool
    {
        if (empty($customerIds) || empty($indicators)) {
            return false;
        }

        // Begin transaction
        $connection = $this->customerScoresTable->getConnection();
        $connection->begin();
        
        try {
            $now = FrozenTime::now();
            
            // Get all relevant customer metrics at once
            $customerMetrics = $this->customerMetricsTable->find()
                ->where(['customer_id IN' => $customerIds])
                ->all()
                ->indexBy('customer_id')
                ->toArray();
            
            // Get existing scores for these customers and indicators
            $existingScores = $this->customerScoresTable->find()
                ->where([
                    'customer_id IN' => $customerIds,
                    'indicator_id IN' => collection($indicators)->extract('id')->toList()
                ])
                ->all()
                ->combine(function ($score) {
                    return $score->customer_id . '-' . $score->indicator_id;
                }, function ($score) {
                    return $score;
                })
                ->toArray();

            foreach ($indicators as $indicator) {
                $config = json_decode($indicator->query, true);
                if (!$config || !isset($config['type'])) {
                    throw new \RuntimeException("Invalid configuration for indicator {$indicator->id}");
                }
                
                foreach ($customerIds as $customerId) {
                    if (!isset($customerMetrics[$customerId])) {
                        continue;
                    }
                    
                    $metrics = $customerMetrics[$customerId];
                    $newScore = $this->calculateScore($metrics, $indicator, $config);
                    $key = $customerId . '-' . $indicator->id;
                    
                    // Check if we have an existing score
                    if (isset($existingScores[$key])) {
                        // Update existing record
                        $scoreEntity = $existingScores[$key];
                        $this->customerScoresTable->patchEntity($scoreEntity, [
                            'indicator_score' => $newScore['score'],
                           
                            'modified_at' => $now
                        ]);
                    } else {
                        // Create new record
                        $scoreEntity = $this->customerScoresTable->newEntity([
                            'customer_id' => $customerId,
                            'indicator_id' => $indicator->id,
                            'indicator_score' => $newScore['score'],
                           
                            'created_at' => $now,
                            'modified_at' => $now
                        ]);
                    }
                    
                    $this->customerScoresTable->saveOrFail($scoreEntity);
                }
            }
    
            
            $connection->commit();
            return true;
            
        } catch (\Exception $e) {
            $connection->rollback();
            throw $e;
        }
    }

    /**
     * Calculate both metric value and score for a given customer metrics and indicator
     */
    private function calculateScore($metrics, $indicator, array $config): array
    {
        $metricValue = $this->calculateMetricValue($metrics, $config);
        $score = $this->determineScore($metricValue, $indicator);
        
        return [
            'value' => $metricValue,
            'score' => $score
        ];
    }

    /**
     * Calculate distribution thresholds for percentile ranges
     *
     * @param Table $customerMetrics
     * @param array $config
     * @return array
     */

    private function calculateDistributionThresholds($customerMetrics, array $config): array
    {

        $metricValues = [];

        $query = $this->buildMetricQuery($customerMetrics, $config);
        $results = $query->disableHydration()->all()->toArray();

        foreach ($results as $row) {
            if (isset($row['metric']) && $row['metric'] !== null) {
                $metricValues[] = $row['metric'];
            }
        }
            
        if (empty($metricValues)) {
            throw new \RuntimeException('No scores found for this indicator');
        }
        
        // Sort values to calculate percentile thresholds
        sort($metricValues);
        $count = count($metricValues);
        
        // Calculate thresholds for 20%, 40%, 60%, and 80%
        $thresholds = [];
        $percentiles = [
            'percentile_20' => 20,
            'percentile_40' => 40,
            'percentile_60' => 60,
            'percentile_80' => 80,
        ];
        foreach ($percentiles as $key => $value) {
            $index = (int)ceil(($value / 100) * $count) - 1;
            $index = max(0, min($index, $count - 1));
            $thresholds[$key] = $metricValues[$index];
        }

        return $thresholds;
    }

    private function buildMetricQuery($customerMetrics, array $config): SelectQuery
    {
        $query = $customerMetrics->find();
        
        switch ($config['type']) {
            case 'direct':
                return $query->select([
                    'customer_id',
                    'metric' => $config['metric']
                ]);
                
            case 'date_diff':
                return $query->select([
                    'customer_id',
                    'metric' => $query->func()->dateDiff([
                        $config['to'] => 'identifier',
                        $config['from'] => 'identifier'
                    ])
                ])->where([
                    "$config[from] IS NOT NULL",
                    "$config[to] IS NOT NULL"
                ]);
                
            case 'add':
                // Validate fields exist
                if (empty($config['fields']) || !is_array($config['fields'])) {
                    throw new \InvalidArgumentException('Combined metric requires fields array');
                }

                return $query->select([
                    'customer_id',
                    'metric' => implode( ' + ', $config['fields'])
                ]);
                
            case 'ratio':
                return $query->select([
                    'customer_id',
                    'metric' => $query->newExpr()
                        ->mul(
                            $query->newExpr()->div($config['numerator'], $config['denominator']),
                            100
                        )
                ]);
                
            default:
                throw new \RuntimeException('Unsupported metric type');
        }
    }

    /**
     * Calculate the metric value for a single customer
     */
    private function calculateMetricValue($metrics, array $config): int
    {
        
        if (!$config || !isset($config['type'])) {
            throw new \RuntimeException('Invalid metric configuration');
        }
        
        switch ($config['type']) {
            case 'direct':
                return ($metrics->{$config['metric']} ?? 0);
                
            case 'date_diff':
                $fromDate = $metrics->{$config['from']};
                $toDate = $metrics->{$config['to']};
                
                if (!$fromDate || !$toDate) {
                    return 0;
                }
                
                if (is_string($fromDate)) {
                    $fromDate = new \DateTime($fromDate);
                }
                if (is_string($toDate)) {
                    $toDate = new \DateTime($toDate);
                }
                
                return $fromDate->diff($toDate)->days;
                
            case 'add':
                $sum = 0;
                foreach ($config['fields'] as $field) {
                    $sum += ($metrics->{$field} ?? 0);
                }
                return $sum;
                
            case 'ratio':
                $numerator = (float)($metrics->{$config['numerator']} ?? 0);
                $denominator = (float)($metrics->{$config['denominator']} ?? 0);
                return $denominator != 0 ? ($numerator / $denominator) * 100 : 0;
                
            default:
                throw new \RuntimeException('Unsupported metric type');
        }
    }

    /**
     * Determine score based on metric value and indicator percentile ranges
     */
    private function determineScore(int $metricValue, $indicator): int
    {
        
        if ($metricValue <= $indicator->percentile_20) {
            return 1;
        } elseif ($metricValue <= $indicator->percentile_40) {
            return 2;
        } elseif ($metricValue <= $indicator->percentile_60) {
            return 3;
        } elseif ($metricValue <= $indicator->percentile_80) {
            return 4;
        } else {
            return 5;
        }
    }


}