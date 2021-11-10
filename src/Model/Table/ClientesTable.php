<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
            ->minLength('cpf', 11, 'Formato de CPF inválido.')
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

    public function getTopDezClientes($data_inicio, $data_fim)
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');
        $query = $reservasTable->find();
        $query->select(['Clientes.nome', "qtd_reservas" => $query->func()->count('Reservas.mesa_id')])
            ->contain(['Clientes'])
            ->where(['Reservas.data_reserva >=' => $data_inicio])
            ->where(['Reservas.data_reserva <=' => $data_fim])
            ->where(['Reservas.status =' => 'Finalizado'])
            ->group(['Reservas.cliente_id'])
            ->order(['qtd_reservas' => 'DESC'])
            ->limit(10);
        return $query;
    }

    public function gerarXlxsClientes($mes)
    {

        switch ($mes) {
            case '1':
                $data_inicio = '2021-01-01';
                $data_fim = '2021-01-31';
                $month = 'Janeiro';
                break;
            case '2':
                $data_inicio = '2021-02-01';
                $data_fim = '2021-02-28';
                $month = 'Fevereiro';
                break;
            case '3':
                $data_inicio = '2021-03-01';
                $data_fim = '2021-03-31';
                $month = 'Março';
                break;
            case '4':
                $data_inicio = '2021-04-01';
                $data_fim = '2021-04-30';
                $month = 'Abril';
                break;
            case '5':
                $data_inicio = '2021-05-01';
                $data_fim = '2021-05-31';
                $month = 'Maio';
                break;
            case '6':
                $data_inicio = '2021-06-01';
                $data_fim = '2021-06-30';
                $month = 'Junho';
                break;
            case '7':
                $data_inicio = '2021-07-01';
                $data_fim = '2021-07-31';
                $month = 'Julho';
                break;
            case '8':
                $data_inicio = '2021-08-01';
                $data_fim = '2021-08-31';
                $month = 'Agosto';
                break;
            case '9':
                $data_inicio = '2021-09-01';
                $data_fim = '2021-09-30';
                $month = 'Setembro';
                break;
            case '10':
                $data_inicio = '2021-10-01';
                $data_fim = '2021-10-31';
                $month = 'Outubro';
                break;
            case '11':
                $data_inicio = '2021-11-01';
                $data_fim = '2021-11-30';
                $month = 'Novembro';
                break;
            case '12':
                $data_inicio = '2021-12-01';
                $data_fim = '2021-12-31';
                $month = 'Dezembro';
                break;
        }

        $dados = $this->getTopDezClientes($data_inicio, $data_fim);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Relatorio');
        $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Top 10 Clientes do Mês de ' . $month);
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:B2')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A2', 'Clientes');
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

            $soma = $item->qtd_reservas + $soma;
            $sheet->setCellValueByColumnAndRow(1, $line, $item->cliente->nome);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->qtd_reservas);
            $line++;
        }
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $richText->createText('Total de reservas:' . $soma);
        $spreadsheet->getActiveSheet()->getCell('B' . $line)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle('B' . $line)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $documento = new Xlsx($spreadsheet);
        $filename = "Relatorio-" . $month .'-' .time() . ".xlsx";
        $destino = WWW_ROOT . "relatorios" . DS;


        if ($documento->save($destino . $filename)) {
            $resultado = false;
        } else {
            $resultado = true;
        }

        return $resultado;
    }
}
