<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCustomerProfiles extends AbstractMigration
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
        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('corporate_number', 'integer', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->addColumn('hw_business_number', 'integer', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->addColumn('employee_number', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('capital', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('revenue', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('recruiting_flg', 'integer', [
            'default' => 0,
            'limit' => 2,
            'null' => true,
        ]);
        $table->addColumn('ignore_flg', 'integer', [
            'default' => 0,
            'limit' => 2,
            'null' => true,
        ]);
        $table->addColumn('remark', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
