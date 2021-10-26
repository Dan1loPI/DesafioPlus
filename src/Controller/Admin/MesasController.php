<?php

namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\FrozenTime;

class MesasController extends AppController
{

    public function index()
    {
        $date = new FrozenTime();
        $date->setToStringFormat('dd/MM/yyyy');

        $this->paginate = [
            'order' => ['num_mesa' => 'ASC'],
            'limit' => 10
        ];

        $mesas = $this->paginate($this->Mesas);

        $this->set(compact('mesas'));
    }


    public function view($id = null)
    {
        $date = new FrozenTime();
        $date->setToStringFormat('dd/MM/yyyy HH:mm:ss');

        $mesa = $this->Mesas->get($id, [
            'contain' => ['Reservas', 'Reservas.Clientes', 'Reservas.Users'],
        ]);

        $this->set('mesa', $mesa);
    }

    public function add()
    {
        $user = TableRegistry::getTableLocator()->get('users');

        $perfilUser = $user->getUserDados($this->Auth->user('id'));

        $mesa = $this->Mesas->newEntity();
        if ($this->request->is('post')) {

            $mesa = $this->Mesas->patchEntity($mesa, $this->request->getData());
            $mesa->usuario_id = $perfilUser->id;

            
            if($this->Mesas->ChecarMesa($mesa)){
                if ($this->Mesas->save($mesa)) {
                    $this->Flash->success('Mesa salva com sucesso!');
    
                    return $this->redirect(['action' => 'index']);
                }
            }else{
                $this->Flash->error(__('Mesa já Cadastrada!'));
            }
        }
        $this->set(compact('mesa'));
    }


    public function edit($id = null)
    {
        $mesa = $this->Mesas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mesa = $this->Mesas->patchEntity($mesa, $this->request->getData());


            if ($this->Mesas->save($mesa)) {
                $this->Flash->success(__('Mesa alterada com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possivel excluir a mesa, tente novamente.'));
        }
        $this->set(compact('mesa'));
    }

}
