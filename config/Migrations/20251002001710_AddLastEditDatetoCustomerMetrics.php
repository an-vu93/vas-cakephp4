<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddLastEditDatetoCustomerMetrics extends AbstractMigration
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
            $table->addColumn('last_edit_date', 'date', [
                'default' => null,            
                'null' => true,
                'after' => 'last_order_date'
            ]);
            $table->update();
    }
}
