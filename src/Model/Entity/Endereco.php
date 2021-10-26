<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Endereco extends Entity
{
    
    protected $_accessible = [
        'cidade_id' => true,
        'cliente_id' => true,
        'lagradouro' => true,
        'numero' => true,
        'complemento' => true,
        'cep' => true,
        'bairro' => true,
        'cidade' => true,
        'cliente' => true,
    ];
}
