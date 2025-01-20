<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerProduct Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $product_type_id
 * @property int|null $industry_id
 * @property int|null $sub_industry_id
 * @property int $cancel_flg
 * @property int $replace_flg
 * @property \Cake\I18n\FrozenDate|null $order_date
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\ProductType $product_type
 * @property \App\Model\Entity\Industry $industry
 * @property \App\Model\Entity\SubIndustry $sub_industry
 */
class CustomerProduct extends Entity
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
        'product_type_id' => true,
        'industry_id' => true,
        'sub_industry_id' => true,
        'cancel_flg' => true,
        'replace_flg' => true,
        'order_date' => true,
        'created' => true,
        'customer' => true,
        'product_type' => true,
        'industry' => true,
        'sub_industry' => true,
    ];
}
