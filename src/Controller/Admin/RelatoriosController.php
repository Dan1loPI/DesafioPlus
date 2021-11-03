<?php
    namespace App\Controller\Admin;

    use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class RelatoriosController extends AppController
    {

        public function index()
        {
    
        }

        public function usuarios()
        {
            
        }

        public function clientes()
        {
            $clientesTable = TableRegistry::getTableLocator()->get('clientes');
            $qtdClientes = $clientesTable->getContaClientes();
            $qtdClientesAtivos = $clientesTable->getContaClientesAtivos();
            $qtdClientesInativos = $clientesTable->getContaClientesInativos();



            $this->set(compact('qtdClientes','qtdClientesAtivos','qtdClientesInativos'));
        }

        public function mesas()
        {
            $mesasTable = TableRegistry::getTableLocator()->get('mesas');
            $qtdMesas = $mesasTable->getContaMesas();
            $qtdMesasAtivas = $mesasTable->getContaMesasAtivas();
            $qtdMesasInativas = $mesasTable->getContaMesasInativas();

            $this->set(compact('qtdMesasInativas','qtdMesasAtivas','qtdMesas'));
        }

        public function reservas()
        {
            $reservasTable = TableRegistry::getTableLocator()->get('reservas');
            $qtdReservasFinalizadas = $reservasTable->getQtdReservasFinalizadas();
            $qtdReservasCanceladas = $reservasTable->getQtdReservasCanceladas();

            $this->set(compact('qtdReservasFinalizadas', 'qtdReservasCanceladas'));
        }

    }