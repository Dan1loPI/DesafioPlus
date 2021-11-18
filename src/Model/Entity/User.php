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
        'nova_senha' => true,
        
        
    ];


    protected $_hidden = [
        'password',
        'confirma_senha',
        'nova_senha'
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
    public function _setNova_senha()
    {
        $this->nova_senha = (new DefaultPasswordHasher)->hash($this->nova_senha);
    }

    public function _setConfirma_senha()
    {
        $this->confirma_senha = (new DefaultPasswordHasher)->hash($this->confirma_senha);
    }
*/

    public function _setPassword()
    {
        $this->password = (new DefaultPasswordHasher)->hash($this->password);
    }

}
