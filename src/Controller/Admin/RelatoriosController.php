<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class RelatoriosController extends AppController
{

    public function index()
    {
    }

    public function clientes()
    {
        $clientesTable = TableRegistry::getTableLocator()->get('clientes');
        $qtdClientes = $clientesTable->getContaClientes();
        $qtdClientesAtivos = $clientesTable->getContaClientesAtivos();
        $qtdClientesInativos = $clientesTable->getContaClientesInativos();


        $this->set(compact('qtdClientes', 'qtdClientesAtivos', 'qtdClientesInativos'));
    }

    public function mesas()
    {
        $mesasTable = TableRegistry::getTableLocator()->get('mesas');
        $qtdMesas = $mesasTable->getContaMesas();
        $qtdMesasAtivas = $mesasTable->getContaMesasAtivas();
        $qtdMesasInativas = $mesasTable->getContaMesasInativas();


        $this->set(compact('qtdMesasInativas', 'qtdMesasAtivas', 'qtdMesas'));
    }

    public function reservas()
    {
        $this->loadModel('Users');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));
        $reservasTable = TableRegistry::getTableLocator()->get('reservas');
        $qtdReservasFinalizadas = $reservasTable->getQtdReservasFinalizadas($perfilUser->id);
        $qtdReservasCanceladas = $reservasTable->getQtdReservasCanceladas($perfilUser->id);


        $this->set(compact('qtdReservasFinalizadas', 'qtdReservasCanceladas'));
    }

    public function usuarios()
    {
        $this->loadModel('Users');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));
        $qtdReservasAgendadas = $this->Users->getQtdReservasAgendadas($perfilUser->id);
        $qtdReservasCanceladas = $this->Users->getQtdReservasCanceladas($perfilUser->id);

        
        $this->set(compact('qtdReservasAgendadas', 'qtdReservasCanceladas'));
    }
}
