<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1><i class="fa fa-address-book"></i> Reservas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Reservas</li>
                    <li class="breadcrumb-item active">Lista de reservas</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title col-12">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        Lista de reservas cadastrados
                        <div class="float-sm-right ">
                            <?= $this->Html->link('<i class="fa fa-address-book"></i> Adicionar',['controller' => 'reservas', 'action' => 'add'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('ID') ?></th>
                                <th><?= $this->Paginator->sort('CLIENTE') ?></th>
                                <th><?= $this->Paginator->sort('MESA') ?></th>
                                <th><?= $this->Paginator->sort('DATA DA RESERVA') ?></th>
                                <th><?= $this->Paginator->sort('OBSERVAÇÃO') ?></th>
                                <th><?= $this->Paginator->sort('STATUS') ?></th>
                                <th class="actions"><?= __('OPÇÕES') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $reserva) : ?>
                                <tr>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $this->Number->format($reserva->id) ?></td>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $reserva->has('cliente') ? $this->Html->link($reserva->cliente->nome, ['controller' => 'Clientes', 'action' => 'view', $reserva->cliente->id]) : '' ?></td>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $reserva->has('mesa') ? $this->Html->link($reserva->mesa->num_mesa, ['controller' => 'Mesas', 'action' => 'view', $reserva->mesa->id]) : '' ?></td>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $reserva->data_reserva ?></td>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $reserva->observacao ?></td>
                                    <td class="text-<?= $reserva->status == 'Finalizado'? 'success': ''; ?>" ><?= $reserva->status ?></td>
                                    <td class="text-center py-0 align-middle col-sm-1">
                                        <div class="btn-group btn-group-sm">
                                            <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'reservas', 'action' => 'view', $reserva->id], ['class' => 'btn btn-outline-info', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['controller' => 'reservas', 'action' => 'edit', $reserva->id], ['class' => 'btn btn-outline-dark btn-sm', 'escape' => false]) ?>
                                            <?= $this->Html->link('<i class="fa fa-check"></i>', ['controller' => 'reservas', 'action' => 'finalizar', $reserva->id],
                                             ['class' => 'btn btn-outline-success btn-sm', 'escape' => false, 'confirm' => __('Deseja Finalizar esta reserva {0}?', $reserva->id)]
                                             ) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?= $this->element('pagination'); ?>
            </div>
        </div>
    </div>
    </div>
</section>










<!--
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva[]|\Cake\Collection\CollectionInterface $reservas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reserva'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservas index large-9 medium-8 columns content">
    <h3><?= __('Reservas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cliente_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mesa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_reserva') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva) : ?>
            <tr>
                <td><?= $this->Number->format($reserva->id) ?></td>
                <td><?= $reserva->has('user') ? $this->Html->link($reserva->user->id, ['controller' => 'Users', 'action' => 'view', $reserva->user->id]) : '' ?></td>
                <td><?= $reserva->has('cliente') ? $this->Html->link($reserva->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $reserva->cliente->id]) : '' ?></td>
                <td><?= $reserva->has('mesa') ? $this->Html->link($reserva->mesa->id, ['controller' => 'Mesas', 'action' => 'view', $reserva->mesa->id]) : '' ?></td>
                <td><?= h($reserva->data_reserva) ?></td>
                <td><?= h($reserva->observacao) ?></td>
                <td><?= h($reserva->created) ?></td>
                <td><?= h($reserva->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reserva->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reserva->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
            -->