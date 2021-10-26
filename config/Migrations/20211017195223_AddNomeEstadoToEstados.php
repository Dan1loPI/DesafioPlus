<?php
use Migrations\AbstractMigration;

class AddNomeEstadoToEstados extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('estados');
        $table->addColumn('nome_estado', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ]);
        $table->update();
    }
}
