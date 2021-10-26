<?php
use Migrations\AbstractMigration;

class AddStatusToReservas extends AbstractMigration
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
        $table = $this->table('reservas');
        $table->addColumn('status', 'enum', ['values' => ['Agendado', 'Em Andamento', 'Finalizado', 'Cancelado'] , 'default' => 'Agendado']);
        $table->update();
    }
}
