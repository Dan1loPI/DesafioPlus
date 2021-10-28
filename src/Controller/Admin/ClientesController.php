<?php

namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class ClientesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'order' => ['nome' => 'ASC'],
            'limit' => 10,
        ];

        $clientes = $this->paginate($this->Clientes);

        $this->set(compact('clientes'));
    }


    public function view($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Contatos', 'Enderecos', 'Enderecos.Cidades', 'Enderecos.Cidades.Estados'],
        ]);

        $this->set('cliente', $cliente);
    }


    public function add()
    {
        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {

            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());

            if ($this->Clientes->save($cliente)) {
                $this->Flash->success('Cliente salvo com sucesso!');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Cliente não foi salvo');
            }
        }
        $this->set(compact('cliente'));
    }

    public function endereco($id = null)
    {
        $this->loadModel('Enderecos');
        $this->loadModel('Cidades');
        $this->loadModel('Estados');

        $endereco = $this->Enderecos->newEntity();
        if ($this->request->is('post')) {
            $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());

            $endereco->cliente_id = $id;

            if ($this->Enderecos->save($endereco)) {
                $this->Flash->success('Endereço adicionado com sucesso');

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Endereço não foi salvo');
            }
        }
        $cidades = $this->Cidades->find('list', ['limit' => 20000]);
        $estados = $this->Estados->find('list', ['limit' => 30]);
        $this->set(compact('endereco', 'cidades', 'estados'));
    }

    public function contato($id = null)
    {
        $this->loadModel('Contatos');

        $contato = $this->Contatos->newEntity();
        if ($this->request->is('post')) {
            $contato = $this->Contatos->patchEntity($contato, $this->request->getData());

            $contato->cliente_id = (int) $id;
            $contato->principal = false;

            if ($this->Contatos->save($contato)) {
                $this->Flash->success('Contato adicionado com sucesso!');

                return $this->redirect(['controller' => 'clientes', 'action' => 'contato', $id]);
            } else {
                
                $this->Flash->error('Contato não foi salvo!');
            }
        }



        $contatosCliente = $this->Contatos->buscaContatos($id);
        $this->set(compact('contato', 'contatosCliente'));
    }


    public function edit($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());


            if ($this->Clientes->save($cliente)) {
                $this->Flash->success('Cliente editado com sucesso!');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Erro ao editar cliente!');
            }
        }
        $this->set(compact('cliente'));
    }


    public function delete($id = null)
    {
    }

    public function deleteContato($id = null)
    {
        $this->loadModel('Contatos');

        $this->request->allowMethod(['post', 'delete']);
        $contato = $this->Contatos->get($id);


        if ($this->Contatos->delete($contato)) {
            $this->Flash->success('removido com sucesso');
            return $this->redirect(['controller' => 'clientes', 'action' => 'contato', $contato->cliente_id]);
        } else {
            $this->Flash->error(__('Erro ao remover contato!'));
        }
    }

    public function alteraStatus($id = null)
    {
        $cliente = $this->Clientes->get($id);
        $cliente->status = 'Inativo';

        if ($this->Clientes->save($cliente)) {
            $this->Flash->success('Status alterado com sucesso!');

            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('Erro ao Inativar este contato!');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function alteraContatoPrincipal($id = null)
    {

        $this->loadModel('Contatos');

        $contato = $this->Contatos->get($id);
        $contato->principal = 1;

        $contatoAnterior = $this->Contatos->desativarAnterior();

    
       
        if($contatoAnterior){
            $contatoAnterior->principal = 0;
            $this->Contatos->save($contatoAnterior);
        }
        
        if ($this->Contatos->save($contato)) {
            $this->Flash->success('Status alterado com sucesso!');

            return $this->redirect(['controller' => 'clientes','action' => 'contato', $contato->cliente_id]);
        } else {
            $this->Flash->error('Erro ao alterar status!');
            return $this->redirect(['action' => 'index']);
        }
    
    }
}
