<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OricohSeriesFixture
 */
class OricohSeriesFixture extends TestFixture
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
                'product_type_id' => 1,
                'cms_flg' => 1,
            ],
        ];
        parent::init();
    }
}
