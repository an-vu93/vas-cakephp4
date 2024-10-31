<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Indicators seed.
 */
class IndicatorsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'name' => '関係期間の点数',
                'query' => '{"metric": "order_span", "type": "date_diff", "from": "first_order_date", "to": "last_order_date"}',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'OBライセンス点数',
                'query' => '{"metric": "oricoh_license_count", "type": "direct"}',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '他ライセンスの点数',
                'query' => '{"metric": "other_license_count", "type": "direct"}',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '受注頻度の点数',
                'query' => '{"metric": "oricoh_license_count", "type": "direct"}',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'お問い合わせの点数',
                'query' => '{"metric": "engagement", "type": "add", "fields": ["in_contact_count", "out_contact_count"]}',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('indicators');
        $table->insert($data)->save();
    }
}
