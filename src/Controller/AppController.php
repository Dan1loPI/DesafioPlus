<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Table\UsersTable;

class AppController extends Controller
{

   
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email'
                    ],
                ],
            ],
            'loginRedirect' => ['controller' => 'welcome', 'action' => 'index'],
            'authError' => false,
            'logoutRedirect' => [
                'controller' => 'users', 
                'action' => 'login']
        ]);
    }

    public function beforeRender(Event $event)
    {
            $prefix = null;
            if($this->request->getParam(['prefix']) !== null){
                $prefix = $this->request->getParam(['prefix']);
            }

            if($prefix == 'admin'){
                if(($this->request->getParam(['action']) !== null) AND ($this->request->getParam(['action']) == 'login') ){
                    $this->viewBuilder()->setLayout('login');
                }else{
                    
                    $user = TableRegistry::getTableLocator()->get('users');

                    $perfilUser = $user->getUserDados($this->Auth->user('id')); 
                    
                    $this->set(compact('perfilUser'));

                    $this->viewBuilder()->setLayout('admin');
                }
            }
    }
}
