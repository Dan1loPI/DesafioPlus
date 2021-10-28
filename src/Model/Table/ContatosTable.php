<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


class ContatosTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('contatos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER',
        ]);
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('numero', 'Apenas Números.')
            ->requirePresence('numero', 'create')
            ->lengthBetween('numero', [8, 11], 'Numero inválido.')
            ->notEmptyString('numero');

        $validator
            ->boolean('principal')
            ->notEmptyString('principal');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));

        return $rules;
    }

    public function buscaContatos($id)
    {
        $query = $this->find()
            ->where(['cliente_id =' => $id]);
        return $query;
    }

    public function desativarAnterior()
    {
       $query = $this->find()
       ->where(['principal =' => 1])
       ->first();
       
       return $query;
    }
}
