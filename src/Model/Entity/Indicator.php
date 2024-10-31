<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Indicator Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $query
 * @property int $active
 * @property int $percentile_20
 * @property int $percentile_40
 * @property int $percentile_60
 * @property int $percentile_80
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CustomerScore[] $customer_scores
 * @property \App\Model\Entity\IndicatorWeight[] $indicator_weights
 */
class Indicator extends Entity
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
        'name' => true,
        'query' => true,
        'active' => true,
        'percentile_20' => true,
        'percentile_40' => true,
        'percentile_60' => true,
        'percentile_80' => true,
        'created' => true,
        'modified' => true,
        'customer_scores' => true,
        'indicator_weights' => true,
    ];
}
