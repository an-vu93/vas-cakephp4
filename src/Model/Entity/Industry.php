<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Industry Entity
 *
 * @property int $id
 * @property string $name
 * @property int $order
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_id
 *
 * @property \App\Model\Entity\CustomerProduct[] $customer_orders
 */
class Industry extends Entity
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
        'order' => true,
        'modified' => true,
        'modified_id' => true,
        'customer_products' => true,
    ];
}
