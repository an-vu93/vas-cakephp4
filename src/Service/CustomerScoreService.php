<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\FrozenTime;

class CustomerScoreService
{
    /**
     * Calculate scores for a specific indicator based on customer metrics
     *
     * @param int $indicatorId The ID of the indicator
     * @return bool Success status
     */
    public function calculateCustomerScores($customerId): bool
    {
        $indicators = TableRegistry::getTableLocator()->get('Indicators');
        $customerMetrics = TableRegistry::getTableLocator()->get('CustomerMetrics');
        $customerScores = TableRegistry::getTableLocator()->get('CustomerScores');
    
    // Get all active indicators
    $activeIndicators = $indicators->find()
        ->where(['active' => 1])
        ->all();
    
    // Get customer metrics
    $metrics = $customerMetrics->get($customerId);
    
    // Begin transaction
    $connection = $customerScores->getConnection();
    $connection->begin();
    
    try {
        $now = FrozenTime::now();
        
        foreach ($activeIndicators as $indicator) {
            // Delete existing score for this customer and indicator
            $customerScores->deleteAll([
                'customer_id' => $customerId,
                'indicator_id' => $indicator->id
            ]);
            
            // Calculate score based on indicator ranges
            $score = $this->determineScore($metrics, $indicator);
            
            // Prepare data for saving
            $data = [
                'customer_id' => $customerId,
                'indicator_id' => $indicator->id,
                'indicator_score' => $score,
                'created_at' => $now,
                'modified_at' => $now
            ];
            
            // Save the score
            $scoreEntity = $customerScores->newEntity($data);
            $customerScores->saveOrFail($scoreEntity);
        }
        
        $connection->commit();
        return true;
    } catch (\Exception $e) {
        $connection->rollback();
        throw $e;
    }
    }

    /**
     * Determine score based on metric value and indicator percentile ranges
     */
    private function determineScore($metrics, $indicator): int
    {
        // Extract the metric value using the indicator's query
        $metricValue = $this->executeIndicatorQuery($metrics, $indicator->query);
        
        // Determine score based on percentile ranges
        if ($metricValue < $indicator->percentile_20) {
            return 1;
        } elseif ($metricValue < $indicator->percentile_40) {
            return 2;
        } elseif ($metricValue < $indicator->percentile_60) {
            return 3;
        } elseif ($metricValue < $indicator->percentile_80) {
            return 4;
        } else {
            return 5;
        }
    }

    /**
     * Execute the indicator query to get the metric value
     */
    private function executeIndicatorQuery($metrics, string $query): float
    {
        // This is a simplified example. You'll need to implement the actual query execution
        // based on your specific needs. The query might reference different metrics fields.
        
        // Example: if query is "order_count", return that metric
        $field = trim($query);
        echo $field;
        return $metrics->$field ?? 0;
    }
}