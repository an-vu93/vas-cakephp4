<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IndustriesFixture
 */
class IndustriesFixture extends TestFixture
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
                'order' => 1,
                'modified' => '2024-10-15 01:05:52',
                'modified_id' => 1,
            ],
        ];
        parent::init();
    }
}
