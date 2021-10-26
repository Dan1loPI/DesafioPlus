<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adicionar Cliente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><?= $this->Html->link('Listar', ['controller' => 'Clientes', 'action' => 'index']) ?></li>
                    <li class="breadcrumb-item active">Adicionar Cliente</li>
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
                        Adicionar Clientes
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($endereco) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Endereço</label>
                                <?= $this->Form->control('logradouro', ['class' => 'form-control', 'label' => false]) ?>
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
                    </div>
                    <div class="col-md-3">
                        <label>Cidade</label>
                        <div class="row">
                            <?= $this->Form->control('cidade_id', ['class' => 'form-control', 'label' => false], ['options' => $cidades]) ?>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <?= $this->Form->button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn  btn-sm btn-outline-primary col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2'], ['escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
