<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCustomerProfiles3 extends AbstractMigration
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
        $table->changeColumn('hw_business_number', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->changeColumn('capital', 'biginteger', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('homepage', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('revenue_year', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => true,
            'after' => 'revenue'
        ]);
        $table->update();
    }
}
