<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Corporation Entity
 *
 * @property int $id
 * @property int|null $corporate_number
 * @property string|null $process
 * @property string|null $correction
 * @property \Cake\I18n\FrozenDate|null $update_date
 * @property \Cake\I18n\FrozenDate|null $change_date
 * @property string|null $name
 * @property int|null $name_image_id
 * @property string|null $kind
 * @property string|null $prefecture_name
 * @property string|null $city_name
 * @property string|null $street_number
 * @property int|null $address_image_id
 * @property string|null $prefecture_code
 * @property string|null $city_code
 * @property string|null $postal_code
 * @property string|null $address_outside
 * @property int|null $address_outside_image_id
 * @property \Cake\I18n\FrozenDate|null $close_date
 * @property string|null $close_cause
 * @property int|null $successor_corporate_number
 * @property string|null $change_cause
 * @property \Cake\I18n\FrozenDate|null $assignment_date
 * @property string|null $is_latest
 * @property string|null $en_name
 * @property string|null $en_prefecture_name
 * @property string|null $en_city_name
 * @property string|null $en_address_outside
 * @property string|null $furigana
 * @property string|null $exclude_from_search
 * @property string|null $hw_business_number
 * @property int|null $number_of_employees
 * @property string|null $homepage
 * @property int|null $capital
 * @property int|null $revenue
 * @property string|null $revenue_year
 */
class Corporation extends Entity
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
        'corporate_number' => true,
        'process' => true,
        'correction' => true,
        'update_date' => true,
        'change_date' => true,
        'name' => true,
        'name_image_id' => true,
        'kind' => true,
        'prefecture_name' => true,
        'city_name' => true,
        'street_number' => true,
        'address_image_id' => true,
        'prefecture_code' => true,
        'city_code' => true,
        'postal_code' => true,
        'address_outside' => true,
        'address_outside_image_id' => true,
        'close_date' => true,
        'close_cause' => true,
        'successor_corporate_number' => true,
        'change_cause' => true,
        'assignment_date' => true,
        'is_latest' => true,
        'en_name' => true,
        'en_prefecture_name' => true,
        'en_city_name' => true,
        'en_address_outside' => true,
        'furigana' => true,
        'exclude_from_search' => true,
        'hw_business_number' => true,
        'number_of_employees' => true,
        'homepage' => true,
        'capital' => true,
        'revenue' => true,
        'revenue_year' => true,
    ];
}
