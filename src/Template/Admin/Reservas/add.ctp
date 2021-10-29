<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adicionar Reserva</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Reservas</li>
                    <li class="breadcrumb-item active">Adicionar Reserva</li>
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

                                <?php

                                $this->Form->templates(
                                    ['dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}']
                                );

                                ?>

                                <?= $this->Form->control('cliente_id', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                            <div class="col-md-6">
                                <label>Data da Reserva</label>
                                <?= $this->Form->control('data_reserva', ['class' => 'form-control', 'label' => false]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label> Selecione uma mesa</label>
                                <?= $this->Form->control('mesa_id', ['class' => 'form-control', 'label' => false]) ?>
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
