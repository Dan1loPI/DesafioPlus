<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ClientesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('clientes');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Contatos', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->hasMany('Enderecos', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->hasMany('Reservas', [
            'foreignKey' => 'cliente_id',
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
            ->minLength('nome', 3, 'No minimo 03 caracteres.')
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 11, 'Formato de CPF inválido.')
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf')
            ->numeric('cpf', 'Apenas Números')
            ->add('cpf', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'CPF já cadastrado!'
            ]);

        $validator
            ->date('data_nasc')
            ->requirePresence('data_nasc', 'create')
            ->notEmptyDate('data_nasc');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['cpf']));

        return $rules;
    }

    public function buscaEstados()
    {
        $query = $this->find()
            ->select(['id', 'uf', 'nome_estado']);
        return $query;
    }

    public function getContaClientes()
    {
        $query = $this->find()
            ->count();

        return $query;
    }
    public function getContaClientesAtivos()
    {
        $query = $this->find()
            ->where(['status =' => 'Ativo'])
            ->count();
        return $query;
    }
    public function getContaClientesInativos()
    {
        $query = $this->find()
            ->where(['status =' => 'Inativo'])
            ->count();
        return $query;
    }
}
