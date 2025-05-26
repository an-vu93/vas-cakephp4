<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerProfile Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $industry_id
 * @property int|null $sub_industry_id
 * @property int|null $prefecture_id
 * @property int|null $corporate_number
 * @property string|null $hw_business_number
 * @property int|null $employee_number
 * @property int|null $capital
 * @property int|null $revenue
 * @property string|null $revenue_year
 * @property int|null $recruiting_flg
 * @property int|null $ignore_flg
 * @property string|null $remark
 * @property string|null $hw_homepage
 * @property string $homepage
 * @property int|null $latest_sale_store_id
 * @property int|null $latest_office_id
 * @property int|null $latest_office_person_id
 * @property int|null $latest_store_id
 * @property int|null $latest_store_person_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Prefecture $prefecture
 * @property \App\Model\Entity\Industry $industry
 * @property \App\Model\Entity\SubIndustry $sub_industry
 * @property \App\Model\Entity\SaleStore $sale_store
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\OfficePerson $office_person
 */
class CustomerProfile extends Entity
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
        'industry_id' => true,
        'sub_industry_id' => true,
        'prefecture_id' => true,
        'corporate_number' => true,
        'hw_business_number' => true,
        'employee_number' => true,
        'capital' => true,
        'revenue' => true,
        'revenue_year' => true,
        'recruiting_flg' => true,
        'ignore_flg' => true,
        'remark' => true,
        'hw_homepage' => true,
        'homepage' => true,
        'latest_sale_store_id' => true,
        'latest_office_id' => true,
        'latest_office_person_id' => true,
        'latest_store_id' => true,
        'latest_store_person_id' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'prefecture' => true,
        'industry' => true,
        'sub_industry' => true,
        'sale_store' => true,
        'office' => true,
        'office_person' => true,
    ];
}
