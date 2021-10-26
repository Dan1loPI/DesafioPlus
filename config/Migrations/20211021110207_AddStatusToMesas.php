<?php
use Migrations\AbstractMigration;

class AddStatusToMesas extends AbstractMigration
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
        $table->addColumn('status', 'enum', ['values' => ['Disponivel', 'Indisponivel', 'Ocupada'] , 'default' => 'Disponivel']);
        $table->update();
    }
}
