<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerOrdersFixture
 */
class CustomerOrdersFixture extends TestFixture
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
                'product_type_id' => 1,
                'industry_id' => 1,
                'sub_industry_id' => 1,
                'cancel_flg' => 1,
                'replace_flg' => 1,
                'order_date' => '2024-10-10',
                'created' => '2024-10-10 04:19:16',
            ],
        ];
        parent::init();
    }
}
