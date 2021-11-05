<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use DateTime;

class ReservasController extends AppController
{


    public function index()
    {


        $date = new FrozenTime();
        $date->setToStringFormat('dd/MM/yyyy HH:mm:ss');

        $reservasTable = TableRegistry::getTableLocator()->get('reservas');

        $pesquisa = $this->request->getQuery('pesquisa');
        $coluna = $this->request->getQuery('coluna');

        switch ($coluna) {
            case '0':
                $coluna = 'Clientes.nome';
                break;
            case '1':
                $coluna = (int) 'Mesas.num_mesa';
                break;

            case '2':
                $coluna = 'Reservas.status';
                break;

            default:
                $coluna = 'Clientes.nome';
                break;
        }

        if ($pesquisa == null) {
            $this->paginate = [
                'contain' => ['Clientes', 'Mesas'],
                'order' => ['id' => 'DESC'],
                'limit' => 7

            ];
        } else {
            $reservasTable = $this->Reservas->find()
                ->contain(['Clientes','Mesas'])
                ->where([$coluna . ' LIKE' => "%$pesquisa%"]);
        }

        $reservas = $this->paginate($reservasTable);

        $this->set(compact('reservas'));
    }


    public function view($id = null)
    {
        $reserva = $this->Reservas->get($id, [
            'contain' => ['Clientes', 'Mesas']
        ]);

        $this->set('reserva', $reserva);
    }

    public function add()
    {
        $user = TableRegistry::getTableLocator()->get('users');
        $perfilUser = $user->getUserDados($this->Auth->user('id'));

        $reserva = $this->Reservas->newEntity();
        if ($this->request->is('post')) {
            $reserva = $this->Reservas->patchEntity($reserva, $this->request->getData());
            $reserva->usuario_id = $perfilUser->id;

            $time = Date::now();

            if ($reserva->data_reserva < $time) {
                $this->Flash->error(__('Data anterior não permitida'));
            } else {

                if ($this->Reservas->checarMesa($reserva)) {
                    if ($this->Reservas->save($reserva)) {
                        $this->Flash->success(__('Reserva agendada com sucesso!'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('Não foi possivel agendar sua reserva!'));
                } else {

                    $this->Flash->error(__('Mesa ocupada ou indispónivel no momento'));
                }
            }
        }

        $clientes = $this->Reservas->Clientes->find('list', [
            'conditions' => ['status =' => 'Ativo'],
            'order' => ['nome' => 'ASC']
        ]);

        $mesas = $this->Reservas->Mesas->find('list', [
            'conditions' => ['status =' => 1],
            'limit' => 50,
        ]);

        $this->set(compact('reserva', 'clientes', 'mesas'));
    }


    public function edit($id = null)
    {

        $this->loadModel('Mesas');

        $reserva = $this->Reservas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserva = $this->Reservas->patchEntity($reserva, $this->request->getData());

            if ($reserva->status == '0') {
                $reserva->status = 'Agendado';
            }
            if ($reserva->status == '1') {
                $reserva->status = 'Em Andamento';
            }
            if ($reserva->status == '2') {
                $reserva->status = 'Finalizado';
            }
            if ($reserva->status == '3') {
                $reserva->status = 'Cancelado';
            }

            $time = Date::now();

            if ($reserva->data_reserva < $time) {
                $this->Flash->error(__('Data anterior não permitida'));
            } else {
                if ($this->Reservas->checarMesa($reserva)) {
                    if ($this->Reservas->save($reserva)) {
                        $this->Flash->success(__('Reserva alterada com sucesso'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('Reserva não alterada!'));
                } else {
                    $this->Flash->error(__('Mesa ocupada ou indispónivel no momento'));
                }
            }
        }


        $clientes = $this->Reservas->Clientes->find('list', ['limit' => 200]);
        $mesas = $this->Reservas->Mesas->find('list', ['limit' => 50]);
        $this->set(compact('reserva', 'clientes', 'mesas'));
    }


    public function finalizar($id = null)
    {
        $reserva = $this->Reservas->get($id);

        $reserva->status = 'Finalizado';

        if ($this->Reservas->save($reserva)) {
            $this->Flash->success(__('Reserva Finalizada com sucesso'));

            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('Erro ao finalizar reserva!'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function export()
    {
        $this->setResponse($this->getResponse()->withDownload('my-file.xls'));


        $data = $this->Reservas->find('all');
        $_serialize = 'data';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }
}
