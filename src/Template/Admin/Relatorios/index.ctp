<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-table"></i> Relatórios</h1>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-purple">
                                    <div class="inner">
                                        <h3>Clientes</h3>

                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <?= $this->Html->link('<i class="fas fa-arrow-circle-right"></i> Ver Mais', ['controller' => 'relatorios', 'action' => 'clientes'], ['escape' => false,  'class' => 'small-box-footer']) ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>Mesas</h3>

                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-table"></i>
                                    </div>
                                    <?= $this->Html->link('<i class="fas fa-arrow-circle-right"></i> Ver mais', ['controller' => 'relatorios', 'action' => 'mesas'], ['escape' => false,  'class' => 'small-box-footer']) ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-orange">
                                    <div class="inner">
                                        <h3>Reservas</h3>

                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-address-book"></i>
                                    </div>
                                    <?= $this->Html->link('<i class="fas fa-arrow-circle-right"></i> Ver Mais', ['controller' => 'relatorios', 'action' => 'reservas'], ['escape' => false,  'class' => 'small-box-footer']) ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Usuários</h3>

                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-cogs"></i>
                                    </div>
                                    <?= $this->Html->link('<i class="fas fa-arrow-circle-right"></i> Ver mais', ['controller' => 'relatorios', 'action' => 'usuarios'], ['escape' => false,  'class' => 'small-box-footer']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>