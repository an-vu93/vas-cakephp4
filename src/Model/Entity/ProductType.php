<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductType Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $sale_state_flg
 *
 * @property \App\Model\Entity\CustomerProduct[] $customer_products
 * @property \App\Model\Entity\OricohSeries[] $oricoh_series
 * @property \App\Model\Entity\ProductTypeCustomerContact[] $product_type_customer_contact
 */
class ProductType extends Entity
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
        'sale_state_flg' => true,
        'customer_products' => true,
        'oricoh_series' => true,
        // 'product_type_customer_contact' => true,
    ];
}
