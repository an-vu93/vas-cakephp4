<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerProfilesFixture
 */
class CustomerProfilesFixture extends TestFixture
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
                'customer_id' => 1,
                'corporate_number' => 1,
                'hw_business_number' => 1,
                'employee_number' => 1,
                'capital' => 1,
                'revenue' => 1,
                'recruiting_flg' => 1,
                'ignore_flg' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2024-11-11 04:58:37',
                'modified' => '2024-11-11 04:58:37',
                'prefecture_id' => 1,
            ],
        ];
        parent::init();
    }
}
