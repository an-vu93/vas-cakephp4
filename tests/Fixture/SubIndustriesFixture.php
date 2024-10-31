<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubIndustriesFixture
 */
class SubIndustriesFixture extends TestFixture
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
                'industry_id' => 1,
                'modified' => '2024-10-15 01:05:34',
                'modified_id' => 1,
            ],
        ];
        parent::init();
    }
}
