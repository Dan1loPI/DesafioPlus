<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class MesasTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('mesas');
        $this->setDisplayField('num_mesa','num_cadeira');
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

    public function list()
    {
        $this->loadModel('Mesas');

        $mesasTable = TableRegistry::getTableLocator()->get('mesas');
        $dados = $mesasTable->find();
     
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Teste');
        $sheet->getStyle('A1:G1')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'usuario_id');
        $sheet->setCellValue('C1', 'num_mesa');
        $sheet->setCellValue('D1', 'num_cadeira');
        $sheet->setCellValue('E1', 'status');
        $sheet->setCellValue('F1', 'created');
        $sheet->setCellValue('G1', 'modified');
        $line = 2;

        foreach ($dados as $item){
            $sheet->setCellValueByColumnAndRow(1, $line, $item->id);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->usuario_id);
            $sheet->setCellValueByColumnAndRow(3, $line, $item->num_mesa);
            $sheet->setCellValueByColumnAndRow(4, $line, $item->num_cadeira);
            $sheet->setCellValueByColumnAndRow(5, $line, $item->status);
            $sheet->setCellValueByColumnAndRow(6, $line, $item->created);
            $sheet->setCellValueByColumnAndRow(7, $line, $item->modified);
            $line++;
        }

        $documento = new Xlsx($spreadsheet);
        $filename = "report-" . time() . ",xlsx";

        $documento->save($filename);
    }
}
