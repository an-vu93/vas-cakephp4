<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubIndustry Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int $order
 * @property int $industry_id
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_id
 *
 * @property \App\Model\Entity\SubIndustry $parent_sub_industry
 * @property \App\Model\Entity\CustomerOrder[] $customer_orders
 * @property \App\Model\Entity\SubIndustry[] $child_sub_industries
 */
class SubIndustry extends Entity
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
        'industry_id' => true,
        'modified' => true,
        'modified_id' => true,
        'parent_sub_industry' => true,
        'customer_orders' => true,
        'child_sub_industries' => true,
    ];
}
