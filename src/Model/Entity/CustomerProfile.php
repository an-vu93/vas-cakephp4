<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerProfile Entity
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $corporate_number
 * @property int|null $hw_business_number
 * @property int|null $employee_number
 * @property int|null $capital
 * @property int|null $revenue
 * @property int|null $recruiting_flg
 * @property int|null $ignore_flg
 * @property string|null $remark
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $prefecture_id
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Prefecture $prefecture
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
        'corporate_number' => true,
        'hw_business_number' => true,
        'employee_number' => true,
        'capital' => true,
        'revenue' => true,
        'recruiting_flg' => true,
        'ignore_flg' => true,
        'remark' => true,
        'created' => true,
        'modified' => true,
        'prefecture_id' => true,
        'customer' => true,
        'prefecture' => true,
    ];
}
