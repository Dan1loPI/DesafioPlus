<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cake\I18n\FrozenTime;

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

    public function getQtdReservasFinalizadas($data_inicio, $data_fim, $usuario_id)
    {
        $query = $this->find()
            ->where(['data_reserva >=' => $data_inicio])
            ->where(['data_reserva <=' => $data_fim])
            ->where(['status =' => 'Finalizado'])
            ->where(['usuario_id =' => $usuario_id])
            ->count();
        return $query;
    }

    public function getQtdReservasCanceladas($data_inicio, $data_fim, $usuario_id)
    {
        $query = $this->find()
            ->where(['data_reserva >=' => $data_inicio])
            ->where(['data_reserva <=' => $data_fim])
            ->where(['status =' => 'Cancelado'])
            ->where(['usuario_id =' => $usuario_id])
            ->count();
        return $query;
    }

    public function getFiltroReserva($data_inicio, $data_fim, $usuario_id)
    {
        $query = $this->find()
            ->contain(['Clientes', 'Mesas'])
            ->select(['id', 'Clientes.nome', 'Mesas.num_mesa', 'data_reserva', 'status'])
            ->where(['data_reserva >=' => $data_inicio])
            ->where(['data_reserva <=' => $data_fim])
            ->where(['reservas.usuario_id =' => $usuario_id]);
        return $query;
    }

    public function getReservasPorDia($data_inicio, $data_fim)
    {
        $query = $this->find();
        $query->select(['data_reserva', "qtd_reserva" => $query->func()->count('data_reserva')])
            ->where(['data_reserva >=' => $data_inicio])
            ->where(['data_reserva <=' => $data_fim])
            ->where(['status =' => 'Finalizado'])
            ->group('data_reserva');
            return $query;
    }

    public function gerarXlxsReserva()
    {
        $dataTempo = FrozenTime::now()->modify('-1 month');
        $data_inicio = $dataTempo->startOfMonth();
        $data_fim = $dataTempo->endOfMonth();

        $dados = $this->getReservasPorDia($data_inicio, $data_fim);


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Relatorio');
        $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Quantidade de reservas por dia no ultimo mês');
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:B2')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A2', 'data_reserva');
        $sheet->setCellValue('B2', 'Quantidade de reservas');
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:B2')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(130, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(130, 'pt');

        $line = 3;
        $soma = 0;

        foreach ($dados as $item) {

            $soma = $item->qtd_reserva + $soma;
            $sheet->setCellValueByColumnAndRow(1, $line, date_format($item->data_reserva, 'd/m/yy'));
            $sheet->setCellValueByColumnAndRow(2, $line, $item->qtd_reserva);
            $line++;
        }
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $richText->createText('Total de reservas:' . $soma);
        $spreadsheet->getActiveSheet()->getCell('B' . $line)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle('B' . $line)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $documento = new Xlsx($spreadsheet);
        $filename = "Relatorio.xlsx";
        $destino = WWW_ROOT . "relatorios" . DS . "reservas" . DS;


        if ($documento->save($destino . $filename)) {
            $resultado = false;
        } else {
            $resultado = true;
        }

        return $resultado;
    }
}
