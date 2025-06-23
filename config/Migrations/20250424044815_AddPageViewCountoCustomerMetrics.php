<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddPageViewCountoCustomerMetrics extends AbstractMigration
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
        $table->addColumn('page_view_count', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
            'after' => 'relationship_strength'
        ]);
        $table->update();
    }
}
