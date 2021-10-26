<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use App\Model\Entity\Mesa;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Mesas behavior
 */
class MesasBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function ChecarMesa(Mesa $mesa)
    {
        $checarMesa = TableRegistry::get('Mesas');
        $consulta = $checarMesa->find()->where(['num_mesa' => $mesa->num_mesa])->first();
        if (empty($consulta)) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }
}
