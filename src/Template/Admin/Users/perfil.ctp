<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Usuários</li>
                    <li class="breadcrumb-item active">Perfil do Usuário</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Perfil do Usuário
                    </h3>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                    <?= $this->Flash->render() ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row d-flex justify-content-center">
                                <div class="row">
                                   
                                    <?php if (!empty($user->image)) { ?>
                                        <?= $this->Html->image('../files/user/' . $user->id . '/' . $user->image, [
                                            'class' => 'img-circle elevation-2 mb-3',
                                            'alt' => 'User Image',
                                            'width' => '180',
                                            'height' => '180',
                                        ]); ?>
                                    <?php } else { ?>
                                        <?= $this->Html->image('../files/user/avatar.jpg', [
                                            'class' => 'img-circle elevation-2 mb-3',
                                            'alt' => 'User Image',
                                            'width' => '180',
                                            'height' => '180',
                                        ]) ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <?= $this->Html->link(__('Alterar Foto'), ['action' => 'alterarFotoPerfil'], ['class' => 'btn btn-dark btn-sm mb-3']) ?>
                            </div>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nome :</b> <a class="float-right"><?= $user->nome ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $user->email ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
             
                </div>
                <div class="card-footer">
                    <div class="col-md-3">
                        <div class="text-right">
                            <?= $this->Html->link('<i class="fa fa-user" aria-hidden="true"></i> Editar', ['controller' => 'users', 'action' => 'edit', $user->id ], ['class' => 'btn btn-dark btn-block', 'escape' => false]) ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</section>


