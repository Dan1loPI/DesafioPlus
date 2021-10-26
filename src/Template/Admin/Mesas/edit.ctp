<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editando Mesa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Mesas</li>
                    <li class="breadcrumb-item active">Editando Mesa</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        Editando Mesa Número :<b> <?= $mesa->num_mesa ?> </b>
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($mesa) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número de cadeiras</label>
                                <?= $this->Form->control('num_cadeira', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <?= $this->Form->select('status',['Inativa', 'Ativa'],['class' => 'form-control']); ?>
                            </div>
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

