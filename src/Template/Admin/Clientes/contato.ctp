<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adicionar contato do cliente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Clientes</li>
                    <li class="breadcrumb-item active">Contato</li>
                    <li class="breadcrumb-item active">Adicionar Contato</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Adicionar contato do cliente
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($contato) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número</label>
                                <?= $this->Form->control('numero', ['class' => 'form-control', 'label' => false]) ?>
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

            <?= $this->Form->end() ?>
        </div>
        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Contatos
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('NÚMEROS') ?></th>
                                <th scope="col"><?= __('PRICIPAL') ?></th>
                                <th scope="col"><?= __('OPÇÕES') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contatosCliente as $contato) : ?>
                                <tr>
                                    <td><?= $contato->numero ?></td>
                                    <td class="text-center  <?= $contato->principal  == 1 ? 'text-success' : '' ?> ">
                                        <h4><?= $contato->principal  == 1 ?  '<i class="fas fa-check-square"></i>'  : '' ?></h4>
                                    </td>
                                    <td class="text-center py-0 align-middle col-sm-1">
                                        <div class="btn-group btn-group-sm">
                                            <?php if($contato->principal == 1): ?>
                                            
                                            <?php else: ?>
                                                <?= $this->Html->link('<i class="fas fa-check-square"></i>', ['controller' => 'clientes', 'action' => 'alteraContatoPrincipal', $contato->id], ['class' => 'btn btn-outline-info', 'escape' => false]) ?>
                                            <?php endif ?>    
                                            <?= $this->Form->postLink(
                                                __('<i class="fas fa-trash-alt"></i>'),
                                                ['controller' => 'clientes', 'action' => 'deleteContato', $contato->id],
                                                ['class' => 'btn btn-outline-danger btn-sm', 'escape' => false, 'confirm' => __('Deseja remover este contato?', $contato->id)]
                                            ) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>