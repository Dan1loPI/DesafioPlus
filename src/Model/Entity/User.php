<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;

use Cake\ORM\Entity;

class User extends Entity
{

    protected $_accessible = [
        'nome' => true,
        'email' => true,
        'password' => true,
        'status' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'confirma_senha' => true,
    ];


    protected $_hidden = [
        'password',
        'confirma_senha',
    ];

    public function ConfirmaSenha()
    {
        if ($this->password == $this->confirma_senha) {
            $this->password = (new DefaultPasswordHasher)->hash($this->password);
            $this->confirma_senha = $this->password;
            return true;
        }

        return false;
    }

    /*
    protected function _setPassword($password)
    {
        if (strlen($password) > 0){
            return (new DefaultPasswordHasher)->hash($password);
        }

    }

    protected function _setConfirmaSenha($confirma_senha){

        if (strlen($confirma_senha) > 0){
            return (new DefaultPasswordHasher)->hash($confirma_senha);
        }
    }*/
}
