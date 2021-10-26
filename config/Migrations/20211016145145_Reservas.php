<?php
use Migrations\AbstractMigration;

class Reservas extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('reservas');
        $table->addColumn('usuario_id', 'integer');
        $table->addColumn('cliente_id', 'integer');
        $table->addColumn('mesa_id', 'integer');
        $table->addColumn('data_reserva', 'datetime');
        $table->addColumn('observacao', 'string', [
            'limit' => 100,
            'null' => true
        ]);
        $table->addForeignKey('usuario_id','users', 'id');
        $table->addForeignKey('cliente_id','clientes', 'id');
        $table->addForeignKey('mesa_id','mesas', 'id');
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
