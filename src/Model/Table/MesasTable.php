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

    public function BuscarMesa($id)
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');

        $query = $reservasTable->find();
            $query->contain(['Mesas', 'Users', 'Clientes'])
            ->where(['Reservas.mesa_id =' => $id]);
        return $query;
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

    public function getReservasPorMesa($data_inicio, $data_fim)
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');

        $query = $reservasTable->find();
        $query->select(['Mesas.num_mesa', "qtd_reserva" => $query->func()->count('Reservas.mesa_id')])
            ->contain(['Mesas'])
            ->where(['Reservas.data_reserva >=' => $data_inicio])
            ->where(['Reservas.data_reserva <=' => $data_fim])
            ->where(['Reservas.status =' => 'Finalizado'])
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

    public function gerarXlsxMesas($data_inicio, $data_fim)
    {
        $dados = $this->getReservasPorMesa($data_inicio, $data_fim);


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Relatorio');
        $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Quantidade de reservas por mesa entre : ' . date_format($data_inicio, 'd/m/Y') . ' até ' . date_format($data_fim, 'd/m/Y'));
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:B2')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A2', 'Mesa');
        $sheet->setCellValue('B2', 'Quantidade de reservas');
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:B2')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(180, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(180, 'pt');

        $line = 3;
        $soma = 0;

        foreach ($dados as $item) {

            $soma = $item->qtd_reserva + $soma;
            $sheet->setCellValueByColumnAndRow(1, $line, $item->mesa->num_mesa);
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
        $destino = WWW_ROOT . "relatorios" . DS . "mesas" . DS;

        if ($documento->save($destino . $filename)) {
            $resultado = false;
        } else {
            $resultado = true;
        }

        return $resultado;
    }
}
