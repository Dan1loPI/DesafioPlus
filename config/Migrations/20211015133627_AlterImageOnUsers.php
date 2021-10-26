<?php
use Migrations\AbstractMigration;

class AlterImageOnUsers extends AbstractMigration
{
  
    public function change()
    {
        $table = $this->table('users');
        $table->changeColumn('image', 'string',[
            'limit' => 60,
            'null' => true
        ]);
        $table->changeColumn('status', 'string',[
            'limit' => 60,
            'null' => true
        ]);
        $table->update();
    }
}
