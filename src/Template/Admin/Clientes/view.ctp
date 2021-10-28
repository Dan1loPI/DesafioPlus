<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Visualizar Cliente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Clientes</li>
                    <li class="breadcrumb-item active">Visualizar Cliente</li>
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
                        Cliente
                    </h3>
                </div>
                <div class="card-body">

                    <div class=" d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Dados cadastrais
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7 ">
                                        <h2 class="lead"><b><?= $cliente->nome ?> </b></h2>
                                        <p class="text-muted text-sm"><b>Data de Nascimento: <?= $cliente->data_nasc ?> </b> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted"></ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <?= $this->Html->image('../files/user/avatar.jpg', [
                                            'class' => 'img-circle elevation-2 mb-3',
                                            'alt' => 'User Image',
                                            'width' => '128',
                                            'height' => '128',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <?= $this->Html->link(__('<i class="fas fa-user"></i> Editar Perfil'), ['action' => 'edit', $cliente->id], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($cliente->contatos)) : ?>
            <div class="col-4">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Contatos
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= __('NÚMERO') ?></th>
                                    <th scope="col"><?= __('PRICIPAL') ?></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cliente->contatos as $contato) : ?>
                                    <tr>
                                        <td><?= $contato->numero ?></td>
                                        <td class="text-center  <?= $contato->principal  == 1 ? 'text-success' : '' ?> ">
                                            <h4><?= $contato->principal  == 1 ?  '<i class="fas fa-check-square"></i>'  : '' ?></h4>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if (!empty($cliente->enderecos)) : ?>
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-address-book" aria-hidden="true"></i>
                        Endereços
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('ENDEREÇO') ?></th>
                                <th scope="col"><?= __('NÚMERO') ?></th>
                                <th scope="col"><?= __('COMPLEMENTO') ?></th>
                                <th scope="col"><?= __('BAIRRO') ?></th>
                                <th scope="col"><?= __('CEP') ?></th>
                                <th scope="col"><?= __('CIDADE') ?></th>
                                <th scope="col"><?= __('ESTADO') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($cliente->enderecos as $endereco) : ?>
                                <tr>
                                    <td><?= $endereco->lagradouro?></td>
                                    <td><?= $endereco->numero ?></td>
                                    <td><?= $endereco->complemento ?></td>
                                    <td><?= $endereco->bairro ?></td>
                                    <td><?= $endereco->cep ?></td>
                                    <td><?= $endereco->cidade->nome_cidade ?></td>
                                    <td><?= $endereco->cidade->estado->nome_estado ?></td>
                                   
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>