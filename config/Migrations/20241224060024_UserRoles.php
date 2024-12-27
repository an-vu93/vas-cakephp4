<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UserRoles extends AbstractMigration
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
        $table = $this->table('user_roles');
        $table->addColumn('employee_number', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('role', 'enum', [
            'values' => ['root', 'owner', 'analyst'],
            'null' => false,
        ]);

        $table->addIndex('employee_number', ['unique' => true]); // Add unique index

        $table->create();
    }
}
