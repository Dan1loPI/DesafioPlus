<?php
use Migrations\AbstractMigration;

class Mesas extends AbstractMigration
{
 
    public function change()
    {
        $table = $this->table('mesas');
        $table->addColumn('usuario_id', 'integer');
        $table->addColumn('status', 'boolean', [
            'default' => 1
        ]);
        $table->addColumn('num_mesa', 'integer', [
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('num_cadeira', 'integer', [
            'limit' => 2,
            'null' => false,
            'default' => 2
        ]);
        $table->addForeignKey('usuario_id','users', 'id');
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
