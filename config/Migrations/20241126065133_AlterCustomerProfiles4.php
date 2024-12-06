<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCustomerProfiles4 extends AbstractMigration
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
        $table->addColumn('industry_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'customer_id'
        ]);
        $table->addColumn('sub_industry_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'industry_id'
        ]);
        $table->update();
    }
}
