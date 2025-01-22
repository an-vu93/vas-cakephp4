<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CorporationsFixture
 */
class CorporationsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'corporate_number' => 1,
                'process' => 'Lorem ipsum dolor sit amet',
                'correction' => 'Lorem ipsum dolor sit amet',
                'update_date' => '2025-01-22',
                'change_date' => '2025-01-22',
                'name' => 'Lorem ipsum dolor sit amet',
                'name_image_id' => 1,
                'kind' => 'Lorem ipsum dolor sit amet',
                'prefecture_name' => 'Lorem ip',
                'city_name' => 'Lorem ipsum dolor ',
                'street_number' => 'Lorem ipsum dolor sit amet',
                'address_image_id' => 1,
                'prefecture_code' => '',
                'city_code' => '',
                'postal_code' => '',
                'address_outside' => 'Lorem ipsum dolor sit amet',
                'address_outside_image_id' => 1,
                'close_date' => '2025-01-22',
                'close_cause' => 'Lorem ipsum dolor sit amet',
                'successor_corporate_number' => 1,
                'change_cause' => 'Lorem ipsum dolor sit amet',
                'assignment_date' => '2025-01-22',
                'is_latest' => 'Lorem ipsum dolor sit amet',
                'en_name' => 'Lorem ipsum dolor sit amet',
                'en_prefecture_name' => 'Lorem i',
                'en_city_name' => 'Lorem ipsum dolor sit amet',
                'en_address_outside' => 'Lorem ipsum dolor sit amet',
                'furigana' => 'Lorem ipsum dolor sit amet',
                'exclude_from_search' => 'Lorem ipsum dolor sit amet',
                'hw_business_number' => 'Lorem ipsum d',
                'number_of_employees' => 1,
                'homepage' => 'Lorem ipsum dolor sit amet',
                'capital' => 1,
                'revenue' => 1,
                'revenue_year' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
