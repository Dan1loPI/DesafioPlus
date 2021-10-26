<?php

use Migrations\AbstractMigration;

class Clientes extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('clientes');

        $table->addColumn('nome', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('cpf', 'string', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex(['cpf'], ['unique' => true]);
        $table->addColumn('data_nasc', 'date', [
            'null' => false,
        ]);

        $table->addColumn('status', 'enum', ['values' => ['Ativo', 'Inativo', 'Bloqueado'] , 'default' => 'Ativo']);

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
