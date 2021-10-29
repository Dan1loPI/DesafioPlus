<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class EnderecosTable extends Table
{
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('enderecos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cidades', [
            'foreignKey' => 'cidade_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('lagradouro')
            ->maxLength('lagradouro', 100)
            ->requirePresence('lagradouro', 'create')
            ->notEmptyString('lagradouro');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 10)
            ->allowEmptyString('numero');

        $validator
            ->scalar('complemento')
            ->maxLength('complemento', 100)
            ->allowEmptyString('complemento');

        $validator
            ->scalar('cep')
            ->maxLength('cep', 8)
            ->requirePresence('cep', 'create')
            ->notEmptyString('cep');

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 40)
            ->requirePresence('bairro', 'create')
            ->notEmptyString('bairro');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cidade_id'], 'Cidades'));
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));

        return $rules;
    }

    public function buscaEnderecos($id)
    {
        $query = $this->find()
            ->where(['cliente_id =' => $id]);
        return $query;
    }
}
