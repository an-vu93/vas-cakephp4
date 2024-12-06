<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCustomerProfiles extends AbstractMigration
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
        $table = $this->table('customer_profiles');
        $table->addColumn('prefecture_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'customer_id'
        ]);
        $table->changeColumn('corporate_number', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->changeColumn('hw_business_number', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->addForeignKey('customer_id', 'customers', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);
        $table->update();
    }
}
