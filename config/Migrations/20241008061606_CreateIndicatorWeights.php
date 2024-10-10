<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIndicatorWeights extends AbstractMigration
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
        $table = $this->table('indicator_weights');
        $table->addColumn('analysis_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('indicator_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('weight', 'integer', [
            'default' => null,
            'limit' => 2,
            'null' => false,
        ]);
        $table->addForeignKey('analysis_id', 'analyses', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);
        $table->addForeignKey('indicator_id', 'indicators', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);
        $table->create();
    }
}
