<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCustomerProfiles2 extends AbstractMigration
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
        $table->changeColumn('corporate_number', 'biginteger', [
            'default' => null,
            'null' => true,
        ]);
        $table->changeColumn('hw_business_number', 'biginteger', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
