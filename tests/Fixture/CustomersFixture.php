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
                'created' => '2024-10-15 05:27:18',
                'modified' => '2024-10-15 05:27:18',
            ],
        ];
        parent::init();
    }
}
