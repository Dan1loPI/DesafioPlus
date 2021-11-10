<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $this->hasMany('Reservas', [
            'foreignKey' => 'usuario_id',
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

    public function getQtdReservasAgendadas($usuario_id)
    {
        $usersTable = TableRegistry::getTableLocator()->get('reservas');
        $query = $usersTable->find()
            ->where(['usuario_id =' => $usuario_id])
            ->count();

        return $query;
    }

    public function getQtdReservasCanceladas($usuario_id)
    {
        $usersTable = TableRegistry::getTableLocator()->get('reservas');
        $query = $usersTable->find()
            ->where(['usuario_id =' => $usuario_id])
            ->where(['status ='=> 'Cancelado'])
            ->count();

        return $query;
    }

    public function topDezFuncionarios()
    {
        $reservasTable = TableRegistry::getTableLocator()->get('Reservas');

        $query = $reservasTable->find();
            $query->select(['Users.id', 'Users.nome','qtd_reservas' => $query->func()->count('Reservas.usuario_id')])
            ->contain(['Users'])
            ->group(['Users.id']);
            
        return $query;
    }

    public function gerarXlxsUsuarios()
    {
        $dados = $this->topDezFuncionarios();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Relatorio');
        $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Top 10 Funcionarios ');
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:B2')->getBorders()->getOutline()->setBorderStyle(true);
        $sheet->setCellValue('A2', 'Funcionario');
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
            $sheet->setCellValueByColumnAndRow(1, $line, $item->user->nome);
            $sheet->setCellValueByColumnAndRow(2, $line, $item->qtd_reservas);
            $line++;
        }
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $richText->createText('Total de reservas:' . $soma);
        $spreadsheet->getActiveSheet()->getCell('B' . $line)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle('B' . $line)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $documento = new Xlsx($spreadsheet);
        $filename = "Relatorio-" .time() . ".xlsx";
        $destino = WWW_ROOT . "relatorios" . DS . "users" . DS;


        if ($documento->save($destino . $filename)) {
            $resultado = false;
        } else {
            $resultado = true;
        }

        return $resultado;
    }
}
