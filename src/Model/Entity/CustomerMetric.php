<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerMetric Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property \Cake\I18n\FrozenTime|null $first_order_date
 * @property \Cake\I18n\FrozenTime|null $last_order_date
 * @property int|null $order_count
 * @property int|null $oricoh_license_count
 * @property int|null $other_license_count
 * @property int|null $in_contact_count
 * @property int|null $out_contact_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class CustomerMetric extends Entity
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
        'first_order_date' => true,
        'last_order_date' => true,
        'order_count' => true,
        'oricoh_license_count' => true,
        'other_license_count' => true,
        'in_contact_count' => true,
        'out_contact_count' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
    ];
}
