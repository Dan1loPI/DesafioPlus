<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


class MesasTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('mesas');
        $this->setDisplayField('num_mesa');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Mesas');

        $this->belongsTo('Users', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Reservas', [
            'foreignKey' => 'mesa_id',
        ]);
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        $validator
            ->integer('num_mesa')
            ->range('num_mesa', [01, 1000], 'Digite um número valido')
            ->requirePresence('num_mesa', 'create')
            ->notEmptyString('num_mesa');

        $validator
            ->integer('num_cadeira')
            ->range('num_cadeira', [01, 04], 'No minimo 01 no maximo 04')
            ->requirePresence('num_mesa', 'create')
            ->notEmptyString('num_cadeira');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['usuario_id'], 'Users'));
        return $rules;
    }

    public function getContaMesas()
    {
        $query = $this->find()
            ->count();
        return $query;
    }

    public function getContaMesasAtivas()
    {
        $query = $this->find()
            ->where(['status =' => 1])
            ->count();
        return $query;
    }

    public function getContaMesasInativas()
    {
        $query = $this->find()
            ->where(['status =' => 0])
            ->count();
        return $query;
    }

    public function getReservasPorMesa($data_inicio, $data_fim, $usuario_id)
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');

        $query = $reservasTable->find();
           $query->select(['Mesas.num_mesa', "teste" => $query->func()->count('Reservas.mesa_id')])
            ->contain(['Mesas'])
            ->where(['Reservas.data_reserva >=' => $data_inicio])
            ->where(['Reservas.data_reserva <=' => $data_fim])
            ->where(['Reservas.status =' => 'Finalizado'])
            ->where(['Reservas.usuario_id =' => $usuario_id])
            ->group(['Reservas.mesa_id']);
        return $query;
    }

    public function getTotalMesas($data_inicio, $data_fim, $usuario_id)
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');
        $query = $reservasTable->find();
            $query->select(["somaReserva" => $query->func()->count('Reservas.mesa_id')])
            ->where(['usuario_id =' => $usuario_id])
            ->where(['data_reserva >=' => $data_inicio])
            ->where(['data_reserva <=' => $data_fim])
            ->where(['status =' => 'Finalizado']);
            
            return $query;
    }
}
