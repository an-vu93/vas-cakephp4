<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerScoresFixture
 */
class CustomerScoresFixture extends TestFixture
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
                'indicator_id' => 1,
                'indicator_score' => 1,
                'created' => '2024-10-29 04:13:12',
                'modified' => '2024-10-29 04:13:12',
            ],
        ];
        parent::init();
    }
}
