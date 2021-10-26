<?php
use Migrations\AbstractMigration;

class Estados extends AbstractMigration
{
   
    public function change()
    {
        $table = $this->table('estados');
        $table->addColumn('nome', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('uf', 'string', [
            'limit' => 3,
            'null' => false,
        ]);
        $table->create();
    }
}
