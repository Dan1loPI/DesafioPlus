<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Reservas Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClientesTable&\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\MesasTable&\Cake\ORM\Association\BelongsTo $Mesas
 *
 * @method \App\Model\Entity\Reserva get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reserva newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reserva[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reserva|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reserva saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reserva patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reserva[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reserva findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReservasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('reservas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Users', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Mesas', [
            'foreignKey' => 'mesa_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('data_reserva')
            ->requirePresence('data_reserva', 'create')
            ->notEmptyDate('data_reserva');

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 100)
            ->allowEmptyString('observacao');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['usuario_id'], 'Users'));
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['mesa_id'], 'Mesas'));

        return $rules;
    }

    public function checarMesa($reserva)
    {
        $consultaMesa = $this->verificaMesa($reserva->mesa_id);

        $dataMesaConvertida = date_format($reserva->data_reserva, "Y/m/d");

        $consulta = $this->find()
            ->select(['Reservas.data_reserva', 'Reservas.status', 'Mesas.num_mesa'])
            ->contain(['Mesas'])
            ->where(['Reservas.data_reserva' => $dataMesaConvertida])
            ->where(['Mesas.num_mesa =' => $consultaMesa->num_mesa])
            ->where(['Reservas.status =' => 'Agendado'])
            ->first();

        if ($consulta) {
            $resultado = false;
        } else {
            $resultado = true;
        }

        return $resultado;
    }

    protected function verificaMesa($id)
    {
        $verificaMesa = TableRegistry::getTableLocator()->get('Mesas');
        $consultaMesa = $verificaMesa->find()
            ->select(['num_mesa'])
            ->where(['id' => $id])
            ->where(['status =' => 1])
            ->first();

        return $consultaMesa;
    }

    public function getQtdReservasFinalizadas($usuario_id)
    {
        $query = $this->find()
            ->where(['status ='=> 'Finalizado' ])
            ->where(['usuario_id =' => $usuario_id])
            ->count();
            return $query;
    }

    public function getQtdReservasCanceladas($usuario_id)
    {
        $query = $this->find()
        ->where(['status ='=> 'Cancelado' ])
        ->where(['usuario_id =' => $usuario_id])
        ->count();
        return $query;
    }
}
