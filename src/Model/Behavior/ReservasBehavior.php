<?php

namespace App\Model\Behavior;

use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Reserva;
use Cake\Datasource\ConnectionManager;



/**
 * Reservas behavior
 */
class ReservasBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];



    public function checarMesa($reserva)
    {


        $verificaMesa = TableRegistry::getTableLocator()->get('Mesas');
        $consultaMesa = $verificaMesa->find()
            ->select(['num_mesa'])
            ->where(['id' => $reserva->mesa_id])
            ->where(['status =' => 1])
            ->first();





        $verificarReserva = TableRegistry::getTableLocator()->get('reservas');

        $consulta = $verificarReserva->find()
            ->select(['Reservas.data_reserva', 'Mesas.num_mesa'])
            ->contain(['Mesas'])
            ->where(['Reservas.data_reserva' => $reserva->data_reserva])
            ->first();

            //var_dump($consulta);

       dd($consulta);


        /*

        if(empty($consultaMesa->num_mesa)){

            if(empty($consulta)){
                $resultado = false;
            }else{
                $resultado = true;
            }

        }else{

            $verificarReserva = TableRegistry::getTableLocator()->get('reservas');
            $consulta = $verificarReserva->find()
            ->select(['Reservas.data_reserva', 'Mesas.num_mesa'])
            ->contain(['Mesas'])
            ->where(['data_reserva' => $reserva->data_reserva])
            ->first();

            if(empty($consulta)){
                $resultado = false;
            }else{
                $resultado = true;
            }

        }*/
    }


    public function alteraStatus($id, $status)
    {
        $alteraStatus = TableRegistry::getTableLocator()->get('Mesas');

        $consultaMesa = $alteraStatus->find()->where(['id' => $id])->first();

        switch ($status) {
            case 'Agendado':
                $consultaMesa->status = 'Ocupada';
                break;

            case 'Em Andamento':
                $consultaMesa->status = 'Ocupada';
                break;

            case 'Finalizado':
                $consultaMesa->status = 'Disponivel';
                break;
            case 'Cancelado':
                $consultaMesa->status = 'Disponivel';
                break;
            default:
                $consultaMesa->status = 'Indisponivel';
                break;
        }

        return $consultaMesa;
    }
}
