<?php
use Migrations\AbstractMigration;

class RemoveNomeFromEstados extends AbstractMigration
{
   
    public function change()
    {
        $table = $this->table('estados');
        $table->removeColumn('nome');
        $table->update();
    }
}
