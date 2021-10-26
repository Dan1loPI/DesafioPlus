<?php
use Migrations\AbstractMigration;

class AddNomeCidadeToCidades extends AbstractMigration
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
        $table = $this->table('cidades');
        $table->addColumn('nome_cidade', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ]);
        $table->update();
    }
}
