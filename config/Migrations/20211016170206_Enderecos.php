<?php
use Migrations\AbstractMigration;

class Enderecos extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('enderecos');
        $table->addColumn('cidade_id', 'integer');
        $table->addColumn('cliente_id', 'integer');
        $table->addColumn('lagradouro', 'string',[
            'limit' => 100,
            'null' => false
        ]);
        $table->addColumn('numero', 'string',[
            'limit' => 10,
            'null' => true
        ]);
        $table->addColumn('complemento', 'string',[
            'limit' => 100,
            'null' => true
        ]);
        $table->addColumn('cep', 'string',[
            'limit' => 8,
            'null' => false
        ]);
        $table->addForeignKey('cidade_id','cidades', 'id');
        $table->addForeignKey('cliente_id','clientes', 'id');
        $table->create();
    }
}

