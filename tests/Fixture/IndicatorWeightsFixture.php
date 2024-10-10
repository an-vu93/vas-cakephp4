<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IndicatorWeightsFixture
 */
class IndicatorWeightsFixture extends TestFixture
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
                'analysis_id' => 1,
                'indicator_id' => 1,
                'weight' => 1,
            ],
        ];
        parent::init();
    }
}
