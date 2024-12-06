<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerScore Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $indicator_id
 * @property int $indicator_score
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Indicator $indicator
 */
class CustomerScore extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'customer_id' => true,
        'indicator_id' => true,
        'indicator_score' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'indicator' => true,
    ];

    /**
     * Get indicator weights for the customer.
     *
     * @throws \Cake\Datasource\Exception\MissingModelException If the table class cannot be found.
     * @return array<int, float>
     */
    protected function _getIndicatorWeights()
    {
        $analysis_id = $this->request->getQuery('analysis_id');
        if (empty($this->$analysis_id)) {
            throw new InvalidArgumentException('Analysis ID is required to fetch indicator weights');
        }

        return TableRegistry::getTableLocator()
            ->get('IndicatorWeights')
            ->find()
            ->select(['indicator_id', 'weight'])
            ->where(['analysis_id' => $analysis_id])
            ->combine('indicator_id', 'weight')
            ->toArray();
    }

    /**
     * Calculate weighted average of customer scores.
     *
     * @return float
     */
    protected function _getWeightedAverage()
    {
        $weights = $this->indicator_weights;
        
        if (empty($weights) || empty($this->customer_scores)) {
            return 0.0;
        }

        $scores = (new Collection($this->customer_scores))
            ->combine('indicator_id', 'indicator_score')
            ->toArray();
        
        $totalWeight = array_sum($weights);
        
        if ($totalWeight <= 0) {
            return 0.0;
        }

        $weightedSum = array_sum(array_map(
            function ($indicatorId, $weight) use ($scores) {
                return isset($scores[$indicatorId]) ? ($scores[$indicatorId] * $weight) : 0;
            },
            array_keys($weights),
            $weights
        ));

        return round($weightedSum / $totalWeight, 2);
    }
}
