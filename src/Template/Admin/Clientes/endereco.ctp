<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adicionar Endereço</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Clientes</li>
                    <li class="breadcrumb-item active">Adicionar Endereço</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-11">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Adicionar Endereço
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($endereco) ?>
                        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Endereço</label>
                                <?= $this->Form->control('lagradouro', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Número</label>
                                <?= $this->Form->control('numero', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Complemento</label>
                                <?= $this->Form->control('complemento', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bairro</label>
                                <?= $this->Form->control('bairro', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CEP</label>
                                <?= $this->Form->control('cep', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Cidade</label>
                            <div class="row">
                                <?= $this->Form->control('cidade_id', ['class' => 'form-control', 'label' => false],['options' => $cidades]) ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Estado</label>
                            <div class="row">
                                <?= $this->Form->control('estado_id', ['class' => 'form-control ml-3', 'label' => false],['options' => $estados]) ?>
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
        </div>
    </div>
  
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-address-book" aria-hidden="true"></i>
                        Endereços
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('ENDEREÇO') ?></th>
                                <th scope="col"><?= __('NÚMERO') ?></th>
                                <th scope="col"><?= __('COMPLEMENTO') ?></th>
                                <th scope="col"><?= __('BAIRRO') ?></th>
                                <th scope="col"><?= __('CEP') ?></th>
                                <th scope="col"><?= __('CIDADE') ?></th>
                                <th scope="col"><?= __('ESTADO') ?></th>
                                <th scope="col"><?= __('OPÇOES') ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($enderecosCliente as $endereco) : ?>
                                <tr>
                                   
                                    <td><?= $endereco->lagradouro?></td>
                                    <td><?= $endereco->numero ?></td>
                                    <td><?= $endereco->complemento ?></td>
                                    <td><?= $endereco->bairro ?></td>
                                    <td><?= $endereco->cep ?></td>
                                    <td><?= $endereco->cidade_id ?></td>
                                    <td><?= $endereco->estado_id ?></td>
                                    <td class="text-center">
                                    <?= $this->Form->postLink(
                                                __('<i class="fas fa-trash-alt"></i>'),
                                                ['controller' => 'clientes', 'action' => 'deleteEndereco', $endereco->id],
                                                ['class' => 'btn btn-outline-danger btn-sm', 'escape' => false, 'confirm' => __('Deseja remover este endereço?', $endereco->id)]
                                            ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    
</section>

