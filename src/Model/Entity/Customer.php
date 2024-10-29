<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $prefecture_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Prefecture $prefecture
 * @property \App\Model\Entity\Industry $industry
 * @property \App\Model\Entity\SubIndustry $sub_industry
 * @property \App\Model\Entity\CustomerContact[] $customer_contacts
 * @property \App\Model\Entity\CustomerOrder[] $customer_orders
 * @property \App\Model\Entity\Project[] $projects
 */
class Customer extends Entity
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
        'prefecture_id' => true,
        'created' => true,
        'modified' => true,
        'prefecture' => true,
        'industry' => true,
        'sub_industry' => true,
        'customer_contacts' => true,
        'customer_orders' => true,
        'projects' => true,
    ];
}
