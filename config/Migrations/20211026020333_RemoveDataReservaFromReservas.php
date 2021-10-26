<?php
use Migrations\AbstractMigration;

class RemoveDataReservaFromReservas extends AbstractMigration
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
        $table->removeColumn('data_reserva');
        $table->update();
    }
}
