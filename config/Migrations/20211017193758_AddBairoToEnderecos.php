<?php
use Migrations\AbstractMigration;

class AddBairoToEnderecos extends AbstractMigration
{
   
    public function change()
    {
        $table = $this->table('enderecos');
        $table->addColumn('bairro', 'string',[
            'limit' => 40,
            'null' => false
        ]);
        $table->update();
    }
}
