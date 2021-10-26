<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reserva Entity
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $cliente_id
 * @property int $mesa_id
 * @property \Cake\I18n\FrozenTime $data_reserva
 * @property string|null $observacao
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Mesa $mesa
 */
class Reserva extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'usuario_id' => true,
        'cliente_id' => true,
        'mesa_id' => true,
        'data_reserva' => true,
        'observacao' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'user' => true,
        'cliente' => true,
        'mesa' => true,
    ];
}
