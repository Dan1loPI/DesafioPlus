<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Http\CallbackStream;
use Cake\I18n\FrozenTime;

class RelatoriosController extends AppController
{

    public function index()
    {
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
        $topDezFun = $this->Users->topDezFuncionarios();
        
        $dir = new Folder(WWW_ROOT . 'relatorios' . DS . 'users' . DS);
        $arquivo = $dir->find('.*\.xlsx');

        $dirData = new Folder(WWW_ROOT . 'relatorios' . DS . 'users' . DS . 'data' . DS);
        $arquivoData = $dirData->find('.*\.xlsx');
       

        $this->set(compact('qtdReservasAgendadas', 'qtdReservasCanceladas', 'topDezFun', 'arquivo', 'arquivoData'));
    }

    public function exportFuncionarios()
    {
        $this->loadModel('Users');

        if ($this->Users->gerarXlxsUsuarios()) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'usuarios']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'usuarios']);
        }
    }

    public function exportFuncionariosData()
    {
        $this->loadModel('Users');

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));

        if ($this->Users->gerarXlxsUsuariosData($data_inicio, $data_fim)) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'usuarios']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'usuarios']);
        }
        
    }

    public function clientes()
    {
        $dir = new Folder(WWW_ROOT . 'relatorios' . DS . 'clientes' . DS);
        $arquivo = $dir->find('.*\.xlsx');
    
        $dirData = new Folder(WWW_ROOT . 'relatorios' . DS . 'clientes' . DS . 'data' . DS);
        $arquivoData = $dirData->find('.*\.xlsx');

        $this->set(compact('arquivo', 'arquivoData'));
    }

    public function exportClientes()
    {

        $this->loadModel('Clientes');

        if ($this->Clientes->gerarXlxsClientes()) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'clientes']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'clientes']);
        }
    }

    public function exportClientesData()
    {
        $this->loadModel('Clientes');

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));
        
            
        if ($this->Clientes->gerarXlxsClientesData($data_inicio, $data_fim)) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'clientes']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'clientes']);
        }
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

        $this->Mesas->gerarXlsxMesas($data_inicio, $data_fim);

        $dir = new Folder(WWW_ROOT . 'relatorios' . DS . 'mesas' . DS);
        $arquivo = $dir->find('.*\.xlsx');


        $sumTotalMesa = $mesasTable->getTotalMesas($data_inicio, $data_fim, $perfilUser->id)->first();
        $reservasPorMesa = $mesasTable->getReservasPorMesa($data_inicio, $data_fim, $perfilUser->id);


        $this->set(compact('qtdMesasInativas', 'qtdMesasAtivas', 'qtdMesas', 'reservasPorMesa', 'sumTotalMesa', 'arquivo'));
    }

    public function reservas()
    {
        $this->loadModel('Users');
        $this->loadModel('Reservas');
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));
        $reservasTable = TableRegistry::getTableLocator()->get('reservas');

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));

        $qtdReservasFinalizadas = $reservasTable->getQtdReservasFinalizadas($data_inicio, $data_fim, $perfilUser->id);
        $qtdReservasCanceladas = $reservasTable->getQtdReservasCanceladas($data_inicio, $data_fim, $perfilUser->id);
      
        $dir = new Folder(WWW_ROOT . 'relatorios' . DS . 'reservas' . DS);
        $arquivo = $dir->find('.*\.xlsx');

        $dirData = new Folder(WWW_ROOT . 'relatorios' . DS . 'reservas' . DS . 'data' . DS);
        $arquivoData = $dirData->find('.*\.xlsx');

        $this->set(compact('qtdReservasFinalizadas', 'qtdReservasCanceladas', 'arquivo','arquivoData'));
    }

    public function exportReservasData()
    {
        $this->loadModel('Reservas');

        $data_inicio = new Date($this->request->getQuery('data_inicio'));
        $data_fim = new Date($this->request->getQuery('data_fim'));

        if ($this->Reservas->gerarXlxsReservaData($data_inicio, $data_fim)) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'reservas']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'reservas']);
        }
        
    }

 

   
    

   

    public function exportReservas()
    {
        $this->loadModel('Reservas');

        if ($this->Reservas->gerarXlxsReserva()) {
            $this->Flash->success('Relatorio gerado com sucesso!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'reservas']);
        } else {
            $this->Flash->error('Relatorio não foi gerado!');
            return $this->redirect(['controller' => 'relatorios', 'action' => 'reservas']);
        }
    }
}
