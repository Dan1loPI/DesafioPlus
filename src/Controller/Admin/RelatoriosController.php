<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));



        $qtdReservasFinalizadas = $reservasTable->getQtdReservasFinalizadas($data_inicio, $data_fim, $perfilUser->id);
        $qtdReservasCanceladas = $reservasTable->getQtdReservasCanceladas($data_inicio, $data_fim, $perfilUser->id);

        $this->paginate = [
            'limit' => 7,
        ];
        $filtroReserva = $this->paginate($reservasTable->getFiltroReserva($data_inicio, $data_fim, $perfilUser->id));

        $this->set(compact('qtdReservasFinalizadas', 'qtdReservasCanceladas', 'filtroReserva'));
    }

    public function usuarios()
    {
        $this->loadModel('Users');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));

        $qtdReservasAgendadas = $this->Users->getQtdReservasAgendadas($perfilUser->id);
        $qtdReservasCanceladas = $this->Users->getQtdReservasCanceladas($perfilUser->id);


        $this->set(compact('qtdReservasAgendadas', 'qtdReservasCanceladas'));
    }

    public function exportMesas()
    {

        $this->loadModel('Mesas');

        $mesasTable = TableRegistry::getTableLocator()->get('mesas');
        $dados = $mesasTable->find();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Teste');
        $sheet->getStyle('A1:G1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'usuario_id');
        $sheet->setCellValue('C1', 'num_mesa');
        $sheet->setCellValue('D1', 'num_cadeira');
        $sheet->setCellValue('E1', 'status');
        $sheet->setCellValue('F1', 'created');
        $sheet->setCellValue('G1', 'modified');
        $line = 2;

        foreach ($dados as $item) {
            $sheet->setCellValueByColumnAndRow(1, $line, $item->id);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->usuario_id);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->num_mesa);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->num_cadeira);
            $sheet->setCellValueByColumnAndRow(5, $line, $item->status);
            $sheet->setCellValueByColumnAndRow(6, $line, $item->created);
            $sheet->setCellValueByColumnAndRow(7, $line, $item->modified);
            $line++;
        }

        $documento = new Xlsx($spreadsheet);
        $filename = "Relatorio" . time() . ".xlsx";
        $destino = WWW_ROOT . "relatorios" . DS;
        $documento->save($destino . $filename);

        return $this->redirect(['controller' => 'relatorios', 'action' => 'mesas']);
    }

    public function exportClientes()
    {
        
    }
}
