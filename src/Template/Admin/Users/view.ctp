<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1><i class="fas fa-user"></i> Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Usuários</li>
                    <li class="breadcrumb-item active">Visualizar usuário</li>
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
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Usuário
                    </h3>
                </div>
                <div class="card-body">

                    <div class=" d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Funcionário
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7 ">
                                        <h2 class="lead"><b><?= $usuario->nome ?></b></h2>
                                        <p class="text-muted text-sm"><b>Email: </b><?= $usuario->email ?> </p>
                                        
                                    </div>
                                    <div class="col-5 text-center">
                                        <?php if (!empty($usuario->image) && ($usuario->image !== 'null' )) { ?>
                                            <?= $this->Html->image('../files/user/' . $usuario->id . '/' . $usuario->image, [
                                                'class' => 'img-circle elevation-2 mb-3',
                                                'alt' => 'User Image1',
                                                'width' => '128',
                                                'height' => '128',
                                            ]); ?>
                                        <?php } else { ?>
                                            <?= $this->Html->image('../files/user/avatar.jpg', [
                                                'class' => 'img-circle elevation-2 mb-3',
                                                'alt' => 'User Image',
                                                'width' => '128',
                                                'height' => '128',
                                            ]) ?>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <?= $this->Html->link(__('<i class="fas fa-user"></i> Editar Perfil'), ['action' => 'edit', $usuario->id], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
