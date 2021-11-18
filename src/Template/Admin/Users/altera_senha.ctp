<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Usuário</li>
                    <li class="breadcrumb-item active">Alterar Senha</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Alterar senha
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($user) ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nova senha</label>
                            <?= $this->Form->control('nova_senha', ['class' => 'form-control', 'label' => false]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirma senha</label>
                            <?= $this->Form->control('confirma_senha', ['class' => 'form-control', 'label' => false]) ?>
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
</section>