<?php
use Migrations\AbstractMigration;

class Contatos extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('contatos');
        $table->addColumn('cliente_id', 'integer');
        $table->addColumn('numero', 'integer', [
            'limit' => 14,
            'null' => false,
        ]);
        $table->addColumn('principal', 'boolean',[
            'default' => 0
        ]);
        $table->addForeignKey('cliente_id', 'clientes', 'id');
        $table->create();
    }
}
