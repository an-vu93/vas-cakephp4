<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddShortNameToIndicators extends AbstractMigration
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
        $table->addColumn('short_name', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
            'after' => 'name',
        ]);
        $table->update();
    }
}
