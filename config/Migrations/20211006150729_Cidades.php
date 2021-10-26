<?php
use Migrations\AbstractMigration;

class Cidades extends AbstractMigration
{
 
    public function change()
    {
        $table = $this->table('cidades');
        $table->addColumn('estado_id', 'integer');
        $table->addColumn('nome', 'string', [
            'limit' => 60,
            'null' => false,
        ]);

        $table->addForeignKey('estado_id','estados', 'id');
      
        $table->create();
    }
}
