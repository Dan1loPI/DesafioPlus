<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Mesas', [
            'foreignKey' => 'mesa_id',
        ]);
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 60)
            ->minLength('nome', 3, 'O nome deve ter no mínimo 3 caracteres!')
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'E-mail já cadastrado!'
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 60)
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'A senha deve ter no mínimo 6 caracteres!',
                ]
            ]);

        $validator
            ->allowEmptyString('confirma_senha', 'create')
            ->notEmptyString('confirma_senha', 'Confirme sua senha')
            ->requirePresence('confirma_senha', 'update')
            ->minLength('confirma_senha', 6, 'A senha deve ter no mínimo 6 caracteres!');


        $validator
            ->scalar('status')
            ->maxLength('status', 60)
            ->notEmptyString('status');

        $validator
            ->scalar('image')
            ->maxLength('image', 60)
            ->notEmptyFile('image');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function getUserDados($usuario_id)
    {
        $query = $this->find()
            ->select(['id', 'nome', 'email', 'image'])
            ->where(['users.id' => $usuario_id]);

        return $query->first();
    }

    public function getUsuariosAtivos()
    {
        $query = $this->request->query = $this->find()
            ->select(['id', 'nome', 'emal'])
            ->where(['users.status =' => 1]);

        return $query;
    }
}
