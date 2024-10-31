<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddColumntoIndicators extends AbstractMigration
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
        $table = $this->table('indicators');
        $table->addColumn('percentile_80', 'integer', [
            'default' => 0,
            'limit' => 11,
            'after' => 'name',
        ]);
        $table->addColumn('percentile_60', 'integer', [
            'default' => 0,
            'limit' => 11,
            'after' => 'name',
        ]);
               $table->addColumn('percentile_40', 'integer', [
            'default' => 0,
            'limit' => 11,
            'after' => 'name',
        ]);
        $table->addColumn('percentile_20', 'integer', [
            'default' => 0,
            'limit' => 11,
            'after' => 'name',
        ]);        
        $table->addColumn('active', 'integer', [
            'default' => 0,
            'limit' => 2,
            'null' => false,
            'after' => 'name',
        ]);
        $table->addColumn('query', 'text', [
            'default' => null,
            'null' => true,
            'after' => 'name',
        ]);
        
        $table->update();
    }
}
