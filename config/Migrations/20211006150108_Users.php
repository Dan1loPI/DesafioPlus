<?php
use Migrations\AbstractMigration;

class Users extends AbstractMigration
{
   
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('nome', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addIndex(['email'], ['unique' => true]);
        $table->addColumn('password', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('status', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('image', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
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
