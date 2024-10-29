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
}
