<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-user"></i> Usuários</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Usuários</li>
                    <li class="breadcrumb-item active">Lista de Usuários</li>
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
                        Lista de usuários cadastrados
                        <div class="float-sm-right ">
                            <?= $this->Html->link('<i class="fas fa-user"></i> Adicionar',['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('ID') ?></th>
                                <th><?= $this->Paginator->sort('NOME') ?></th> 
                                <th><?= $this->Paginator->sort('EMAIL') ?></th>
                                <th><?= $this->Paginator->sort('STATUS') ?></th>
                                <th><?= __('Opções') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?= $this->Number->format($usuario->id) ?></td>
                                    <td><?= $usuario->nome ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td><?= $usuario->status == 1? 'Ativo' : 'Inativo' ?></td>
                                    <td class="text-center py-0 align-middle col-sm-1">
                                        <div class="btn-group btn-group-sm">
                                            <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Users', 'action' => 'view', $usuario->id], ['class' => 'btn btn-outline-info', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $usuario->id], ['class' => 'btn btn-outline-dark btn-sm', 'escape' => false]) ?>
                                            <?= $this->Html->link(
                                                __('<i class="fas fa-user-minus"></i>'),
                                                ['action' => 'delete', $usuario->id],
                                                ['class' => 'btn btn-outline-danger btn-sm', 'escape' => false, 'confirm' => __('Deseja desativar esse usuário?', $usuario->id)]
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