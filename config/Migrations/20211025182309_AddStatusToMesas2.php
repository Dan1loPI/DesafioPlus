<?php
use Migrations\AbstractMigration;

class AddStatusToMesas2 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('mesas');
        $table->addColumn('status', 'boolean', [
            'default' => 1
        ]);
        $table->update();
    }
}
