<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomersFixture
 */
class CustomersFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'prefecture_id' => '',
                'industry_id' => 'Lorem ipsum dolor sit amet',
                'sub_industry_id' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-10-10 04:19:21',
                'modified' => '2024-10-10 04:19:21',
            ],
        ];
        parent::init();
    }
}
