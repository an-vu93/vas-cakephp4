<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerMetricsFixture
 */
class CustomerMetricsFixture extends TestFixture
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
                'first_order_date' => '2024-10-15 05:26:14',
                'last_order_date' => '2024-10-15 05:26:14',
                'order_count' => 1,
                'oricoh_license_count' => 1,
                'other_license_count' => 1,
                'in_contact_count' => 1,
                'out_contact_count' => 1,
                'created' => '2024-10-15 05:26:14',
                'modified' => '2024-10-15 05:26:14',
            ],
        ];
        parent::init();
    }
}
