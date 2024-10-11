<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StaffsFixture
 */
class StaffsFixture extends TestFixture
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
                'team_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'kana' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'login_id' => 'Lorem ipsum dolor sit amet',
                'login_pw' => 'Lorem ipsum dolor sit amet',
                'retire_flg' => 1,
                'remarks' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
