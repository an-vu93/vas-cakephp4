<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IndicatorWeight Entity
 *
 * @property int $id
 * @property int $analysis_id
 * @property int $indicator_id
 * @property int $weight
 *
 * @property \App\Model\Entity\Analysis $analysis
 * @property \App\Model\Entity\Indicator $indicator
 */
class IndicatorWeight extends Entity
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
        'analysis_id' => true,
        'indicator_id' => true,
        'weight' => true,
        'analysis' => true,
        'indicator' => true,
    ];
}
