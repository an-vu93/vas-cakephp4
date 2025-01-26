<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCustomerMetrics extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('customer_metrics');

        $table->addColumn('option_included_order_count', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'verup_count',
        ]);

        $table->addColumn('all_order_amount', 'biginteger', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'verup_count',
        ]);

        $table->addColumn('week_edit_count', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'verup_count',
        ]);

        $table->addColumn('week_login_count', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'verup_count',
        ]);
        
        $table->update();
    }
}
