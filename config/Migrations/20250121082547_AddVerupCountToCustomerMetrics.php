<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddVerupCountToCustomerMetrics extends AbstractMigration
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
        $table->addColumn('verup_count', 'integer', [
            'default' => 0,
            'null' => false,
            'limit' => 11,
            'after' => 'out_contact_count',
        ]);
        $table->update();
    }
}
