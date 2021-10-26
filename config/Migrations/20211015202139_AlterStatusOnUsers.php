<?php
use Migrations\AbstractMigration;

class AlterStatusOnUsers extends AbstractMigration
{
   
    public function change()
    {
        $table = $this->table('users');
        $table->changeColumn('status', 'boolean',[
            'limit' => 60,
            'null' => true,
            'default' => 1
        ]);
        $table->update();
    }
}
