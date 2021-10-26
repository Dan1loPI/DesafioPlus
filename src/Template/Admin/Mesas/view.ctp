<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Visualizar Mesa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Mesas</li>
                    <li class="breadcrumb-item active">Visualizar mesa</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Informações sobre a mesa
                    </h3>
                </div>
                <div class="card-body">

                    <div class=" d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <b>Mesa Nº :</b> <?= $mesa->num_mesa ?>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7 ">
                                        <p class="text-muted text-sm"><b>Status: </b> <?= $mesa->status === true ? 'Ativa' : 'Inativa' ?></p>
                                        <p class="text-muted text-sm"><b>Quantidade de cadeiras: </b> <?= $mesa->num_cadeira ?></p>
                                    </div>

                                    <div class="col-5 text-center">

                                        <?= $this->Html->image('../files/mesas/mesa.jpg', [
                                            'class' => 'img-circle elevation-2 mb-3',
                                            'alt' => 'Mesa',
                                            'width' => '128',
                                            'height' => '128',
                                        ]) ?>


                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <?= $this->Html->link(__('<i class="fas fa-user"></i> Editar Mesa'), ['action' => 'edit', $mesa->id], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-user" aria-hidden="true"></i>
                Informações sobre reservas da mesa
            </h3>
        </div>
        <div class="card-body">
            <table  class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= __('ID') ?></th>
                        <th scope="col"><?= __('FUNCIONÁRIO') ?></th>
                        <th scope="col"><?= __('CLIENTE') ?></th>
                        <th scope="col"><?= __('DATA DA RESERVA') ?></th>
                        <th scope="col"><?= __('SITUAÇÃO') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mesa->reservas as $reservas) : ?>
                
                        <tr>
                            <td><?= $reservas->id ?></td>
                            <td><?= $reservas->user->nome ?></td>
                            <td><?= $reservas->cliente->nome?></td>
                            <td><?= $reservas->data_reserva ?></td>
                            <td><?= $reservas->status ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>






<!--

<div class="mesas view large-9 medium-8 columns content">
    <h3><?= h($mesa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $mesa->has('user') ? $this->Html->link($mesa->user->id, ['controller' => 'Users', 'action' => 'view', $mesa->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mesa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Mesa') ?></th>
            <td><?= $this->Number->format($mesa->num_mesa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Cadeira') ?></th>
            <td><?= $this->Number->format($mesa->num_cadeira) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mesa->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mesa->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $mesa->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reservas') ?></h4>
        <?php if (!empty($mesa->reservas)) : ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Usuario Id') ?></th>
                    <th scope="col"><?= __('Cliente Id') ?></th>
                    <th scope="col"><?= __('Mesa Id') ?></th>
                    <th scope="col"><?= __('Data Reserva') ?></th>
                    <th scope="col"><?= __('Observacao') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($mesa->reservas as $reservas) : ?>
                    <tr>
                        <td><?= h($reservas->id) ?></td>
                        <td><?= h($reservas->usuario_id) ?></td>
                        <td><?= h($reservas->cliente_id) ?></td>
                        <td><?= h($reservas->mesa_id) ?></td>
                        <td><?= h($reservas->data_reserva) ?></td>
                        <td><?= h($reservas->observacao) ?></td>
                        <td><?= h($reservas->created) ?></td>
                        <td><?= h($reservas->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Reservas', 'action' => 'view', $reservas->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Reservas', 'action' => 'edit', $reservas->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reservas', 'action' => 'delete', $reservas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservas->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

                -->