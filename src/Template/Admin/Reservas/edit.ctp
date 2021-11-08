<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editar Reserva</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Reservas</li>
                    <li class="breadcrumb-item active">Editar Reserva</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                        Informações da reserva
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($reserva) ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Cliente</label>
                                <?= $this->Form->control('cliente_id', ['class' => 'form-control', 'label' => false], ['options' => $clientes]) ?>
                            </div>
                            <div class="col-md-6">
                                <label>Data da Reserva</label>
                                <?= $this->Form->control('data_reserva', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label> Selecione uma mesa</label>
                                <?= $this->Form->control('mesa_id', ['class' => 'form-control', 'label' => false], ['options' => $mesas]) ?>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <?= $this->Form->select('status',['Agendado', 'Finalizado', 'Cancelado'], ['class' => 'form-control']); ?>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Observações</label>
                                <?= $this->Form->control('observacao', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <?= $this->Form->button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn  btn-sm btn-outline-primary col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2'], ['escape' => false]) ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!--


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reserva->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reservas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservas form large-9 medium-8 columns content">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <legend><?= __('Edit Reserva') ?></legend>
        <?php
            echo $this->Form->control('usuario_id', ['options' => $users]);
            echo $this->Form->control('cliente_id', ['options' => $clientes]);
            echo $this->Form->control('mesa_id', ['options' => $mesas]);
            echo $this->Form->control('data_reserva');
            echo $this->Form->control('observacao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
        -->