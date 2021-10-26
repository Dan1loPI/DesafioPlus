<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Alterar foto de Perfil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><?= $this->Html->link('Home', ['controller' => 'welcome', 'action' => 'index']) ?></li>
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
                        Editar Foto
                    </h3>
                </div>
                <div class="card-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($user, ['type' => 'file']) ?>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label><span class="text-danger">*</span>Foto (180x180)</label>
                            <?= $this->Form->control('image', ['type' => 'file', 'label' => false, 'onchange' => 'previewImage()']) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?php
                            if ($user->image !== "") {
                                $image_antiga = '../../files/user/' . $user->id . '/' . $user->image;
                            } else {
                                $image_antiga = '../../files/user/avatar.jpg';
                            }

                            ?>
                            <img src="<?= $image_antiga ?>" alt="<?= $user->name ?>" id="preview-img"  class="img-thubnail" style="width: 180px; height: 180px;">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-3">
                        <div class="text-right">
                            <?= $this->Form->button('<i class="fa fa-user" aria-hidden="true"></i> Salvar', ['class' => 'btn btn-dark btn-block', 'escape' => false]); ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</section>