<?php
use Migrations\AbstractMigration;

class AddNumeroToContatos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('contatos');
        $table->addColumn('numero', 'string', [
            'limit' => 15,
            'null' => false,
        ]);
        $table->update();
    }
}
