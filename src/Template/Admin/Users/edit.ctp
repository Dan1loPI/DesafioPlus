<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1><i class="fas fa-user-edit"></i> Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Usuários</li>
                    <li class="breadcrumb-item active">Editar Usuário</li>
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
                    <div class="row">
                        <h3 class="card-title ">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Editar Usuário
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    <?= $this->Form->create($usuario) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <?= $this->Form->control('nome', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <?= $this->Flash->render(); ?>
                <div class="card-footer">
                    <div class="text-right">
                        <?= $this->Form->button('<i class="fa fa-save" aria-hidden="true"></i> Salvar', ['class' => 'btn  btn-sm btn-outline-primary col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2'], ['escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>