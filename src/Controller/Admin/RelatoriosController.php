<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

class RelatoriosController extends AppController
{

    public function index()
    {
    }

    public function clientes()
    {
        $this->loadModel('Clientes');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));

        $data_inicio = null;
        $clientesTable = TableRegistry::getTableLocator()->get('clientes');
        $qtdClientes = $clientesTable->getContaClientes();
        $qtdClientesAtivos = $clientesTable->getContaClientesAtivos();
        $qtdClientesInativos = $clientesTable->getContaClientesInativos();
        
        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));

        $topCincoClientes = $clientesTable->getTopCincoClientes($data_inicio, $data_fim, $perfilUser->id);

        $conditions = [];

        if ($data_inicio && $data_fim) {
            $conditions[] = [
                'data_nasc >=' => $data_inicio,
                'data_nasc <=' => $data_fim,
            ];
        }

        $this->paginate = [
            'conditions' => $conditions
        ];

        $clientesTable = $this->paginate($this->Clientes);
        $this->set(compact('qtdClientes', 'qtdClientesAtivos', 'qtdClientesInativos', 'clientesTable', 'topCincoClientes'));
    }

    public function mesas()
    {
        $this->loadModel('Mesas');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));
        $mesasTable = TableRegistry::getTableLocator()->get('mesas');
        $qtdMesas = $mesasTable->getContaMesas();
        $qtdMesasAtivas = $mesasTable->getContaMesasAtivas();
        $qtdMesasInativas = $mesasTable->getContaMesasInativas();


        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));


        $sumTotalMesa = $mesasTable->getTotalMesas($data_inicio, $data_fim, $perfilUser->id)->first();
        $reservasPorMesa = $mesasTable->getReservasPorMesa($data_inicio, $data_fim, $perfilUser->id);


        $this->set(compact('qtdMesasInativas', 'qtdMesasAtivas', 'qtdMesas', 'reservasPorMesa', 'sumTotalMesa'));
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

    public function exportMesas()
    {
        $this->loadModel('Mesas');

        $dados = $this->Mesas->find();
        $_serialize = 'dados';

        $this->viewBuilder()
            ->setClassName('CsvView.Csv');
        $this->set(compact('dados', '_serialize'));
        $this->setResponse($this->getResponse()->withDownload('relatorio.xls'));
    }
}
