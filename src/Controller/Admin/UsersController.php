<?php

namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class UsersController extends AppController
{

    public function index()
    {

        $usuariosAtivos = TableRegistry::getTableLocator()->get('users');
        $this->paginate = [
            'limit' => 8
        ];
        $teste = $this->request->getQuery('teste');

        $coluna = $this->request->getQuery('coluna');

        switch ($coluna) {
            case '0':
                $coluna = 'nome';
                break;
            case '1':
                $coluna = 'email';
                break;

            default:
                $coluna = 'nome';
                break;
        }

        if($teste == null){
        
        }else{
            $usuariosAtivos = $this->Users->find()
            ->where([$coluna . ' LIKE' => "%$teste%"]);
        }


        $usuarios = $this->paginate($usuariosAtivos);
        $this->set(compact('usuarios'));
    }


    public function view($id = null)
    {
        $usuario = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('usuario'));
    }


    public function add()
    {
        $usuario = $this->Users->newEntity(); //instancia o usuario.

        if ($this->request->is('post')) {
            $usuario = $this->Users->patchEntity($usuario, $this->request->getData()); //Recebe os dados vindo do usuário!

            if ($usuario->getErrors()) {
                $this->Flash->error('Campos incorretos');
            } else {

                if ($usuario->ConfirmaSenha()) {

                    if ($this->Users->save($usuario)) {
                        $this->Flash->success('Usuário salvo com sucesso!');
                        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                    } else {
                        $this->Flash->error('Erro ao adicionar usuário. Tente novamente!');
                    }
                } else {
                    $this->Flash->error('As senhas não conferem!');
                }
            }
        }



        $this->set(compact('usuario')); // Manda para a View.
    }


    public function edit($id = null)
    {
        $usuario = $this->Users->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['post', 'patch', 'put'])) {
            $usuario = $this->Users->patchEntity($usuario, $this->request->getData()); //Recebe os dados vindo do usuário!

            if ($usuario->getErrors()) {
                $this->Flash->error('Campos incorretos.');
            } else {
                if ($this->Users->save($usuario)) {
                    $this->Flash->success('Usuário salvo com sucesso!');
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                } else {
                    $this->Flash->error('Erro ao editar usuário. Tente novamente!');
                }
            }
        }

        $this->set(compact('usuario'));
    }



    public function alterarFotoPerfil()
    {

        $user_id =  $this->Auth->user('id');
        $user = $this->Users->get($user_id);


        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);
            $destino = WWW_ROOT . "files" . DS . "user" . DS . $user_id . DS;            // DS é o separador de barras
            $user = $this->Users->newEntity();
            $user->image =  $this->Users->singleUpload($this->request->getData()['image'], $destino);

            $imagemAntiga = $user->image;

            if ($user->image) {
                $user->id = $user_id;
                if ($this->Users->save($user)) {
                    if (($imagemAntiga !== null) and ($imagemAntiga !== $user->image)) {
                        unlink($destino . $imagemAntiga);                                  // exclui a imagem antiga
                    }
                    $this->Flash->success(__('Foto alterada com sucesso!'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'perfil']);
                }
            } else {
                $this->Flash->error(__('Erro ao editar a foto. Tente novamente!'));
            }
        }

        $this->set(compact('user'));
    }


    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        $user->status = 0;

        if ($this->Users->save($user)) {
            $this->Flash->success('Usuários inativado com sucesso');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('Erro ao inativar este usuário');
        }
    }

    public function login()
    {
        if ($this->request->is('post')) { // request para receber os dasdos is para verificar se é via post
            $user =  $this->Auth->identify();

            if ($user) {
                if ($user['status'] == true) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error(__('Usuário desativado'));
                }
            } else {
                $this->Flash->error(__('Usuário ou senha incorretos'));
            }
        }
    }

    public function logout()
    {
        $this->Flash->success('Deslogado com sucesso!');
        return $this->redirect($this->Auth->logout());
    }

    public function perfil()
    {
        $user_id = $this->Auth->user('id');
        $user = $this->Users->get($user_id);

        $this->set(compact('user'));
    }
}
