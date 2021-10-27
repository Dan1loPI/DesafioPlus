<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Visualizar reserva</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Reservas</li>
                    <li class="breadcrumb-item active">Visualizar reserva</li>
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
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        Reserva
                    </h3>
                </div>
                <div class="card-body">

                    <div class=" d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <div class="row">
                                    <b class="text-dark"> Reserva Numero: <?= $reserva->id  ?></b>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-6 ">

                                        <h2 class="lead"><b></b></h2>
                                        <p class="text-muted text-sm"><b>Cliente :</b><?= $reserva->cliente->nome ?> </p>
                                        <p class="text-muted text-sm"><b>CPF :</b><?= $reserva->cliente->cpf ?> </p>
                                        <p class="text-muted text-sm"><b>Data Nascimento :</b><?= $reserva->cliente->data_nasc ?> </p>
                                        <p class="text-muted text-sm"><b>Mesa :</b><?= $reserva->mesa->num_mesa ?> </p>
                                        <p class="text-muted text-sm"><b>Quandidade de cadeira :</b><?= $reserva->mesa->num_cadeira ?> </p>

                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted text-sm"><b>Data da Reserva :</b><?= $reserva->data_reserva ?> </p>
                                        <p class="text-muted text-sm"><b>Data da Reserva :</b><?= $reserva->status ?> </p>
                                        <?php if ($reserva->status == 'Finalizado') : ?>
                                            <p class="text-muted text-sm"><b>Data da Finalização :</b><?= date_format($reserva->modified, "d/m/Y H:m:s") ?> </p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <?php if ($reserva->status == 'Finalizado') : ?>
                                        
                                    <?php else : ?>
                                        <?= $this->Html->link(__('<i class="fa fa-address-book"></i> Editar Reserva'), ['action' => 'edit', $reserva->id], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>