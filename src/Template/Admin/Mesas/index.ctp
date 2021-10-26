<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-table"></i> Mesas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Mesas</li>
                    <li class="breadcrumb-item active">Lista de Mesas</li>
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
                        Lista de mesas cadastrados
                        <div class="float-sm-right ">
                            <?= $this->Html->link('<i class="fas fa-table"></i> Adicionar', ['controller' => 'mesas', 'action' => 'add'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Nº MESA') ?></th>
                                <th><?= __('Nº CADEIRAS') ?></th>
                                <th scope="col"><?= __('STATUS') ?></th>
                                <th><?= __('OPÇÕES') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mesas as $mesa) : ?>
                                <tr>
                                    <td class="text-<?= $mesa->status == 1 ? 'green' : 'danger';  ?>"><?= 'Mesa : ' . $this->Number->format($mesa->num_mesa) ?></td>
                                    <td class="text-<?= $mesa->status == 1 ? 'green' : 'danger';  ?>"><?= $this->Number->format($mesa->num_cadeira) . ' Cadeiras';  ?></td>
                                    <td class="text-<?= $mesa->status == 1 ? 'green' : 'danger';  ?>" ><?= $mesa->status == 1 ? 'Ativa' : 'Inativa' ?></td>
                                    <td class="text-center py-0 align-middle col-sm-1">
                                        <div class="btn-group btn-group-sm">
                                            <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Mesas', 'action' => 'view', $mesa->id], ['class' => 'btn btn-outline-info', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $mesa->id], ['class' => 'btn btn-outline-dark btn-sm', 'escape' => false]) ?>

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