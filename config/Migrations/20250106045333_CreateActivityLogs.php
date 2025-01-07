<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateActivityLogs extends AbstractMigration
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
        $table = $this->table('activity_logs');
        $table->addColumn('employee_number', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('employee_name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('action', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('controller', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('type', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'null' => false,
        ]);
        $table->addColumn('ip_address', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['employee_number', 'employee_name']);
        $table->create();
    }
}
