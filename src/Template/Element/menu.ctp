<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="image">
        <?= $this->Html->image('norven.png', [
            'url' => ['controller' => 'welcome', 'action' => 'index'],
            'class' => 'brand-image img-circle elevation-3',
            'width' => '40',
            'height' => '40',
            'alt' => 'Desafio Norven'
        ]) ?>
        <?= $this->Html->link('Desafio Norven', ['controller' => 'welcome', 'action' => 'index', 'class' => 'nav-link']) ?>
    </div>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <?php if (!empty($perfilUser->image)) { ?>
                    <?= $this->Html->image('../files/user/' . $perfilUser->id . '/' . $perfilUser->image, [
                        'url' => ['controller' => 'users', 'action' => 'view', $perfilUser->id],
                        'class' => 'img-circle elevation-2 mb-3',
                        'alt' => 'User Image',
                        'width' => '40',
                        'height' => '40',
                    ]); ?>
                <?php } else { ?>
                    <?= $this->Html->image('../files/user/avatar.jpg', [
                        'url' => ['controller' => 'users', 'action' => 'view', $perfilUser->id],
                        'class' => 'img-circle elevation-2 mb-3',
                        'alt' => 'User Image',
                        'width' => '40',
                        'height' => '40',
                    ]) ?>
                <?php } ?>
            </div>
            <div class="info">
                <?= $this->Html->link(current(str_word_count($perfilUser->nome, 2)), ['controller' => 'users', 'action' => 'perfil', $perfilUser->id]) ?>

            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-tachometer-alt"></i> Dashboard', ['controller' => 'welcome', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link']) ?>

                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="nav-icon fa fa-users"></i><p>Usuários<i class="fas fa-angle-left right"></i></p>', ['controller' => 'users', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link']) ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa fa-user-plus nav-icon"></i> <p>Adicionar</p>', ['controller' => 'users', 'action' => 'add'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa-list-alt nav-icon"></i> <p>Listar</p>', ['controller' => 'users', 'action' => 'index'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Clientes
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa fa-user-plus nav-icon"></i> <p>Adicionar</p>', ['controller' => 'clientes', 'action' => 'add'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa-list-alt nav-icon"></i> <p>Listar</p>', ['controller' => 'clientes', 'action' => 'index'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        <p>
                            Mesas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> <p>Adicionar</p>', ['controller' => 'mesas', 'action' => 'add'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa-list-alt nav-icon"></i> <p>Listar</p>', ['controller' => 'mesas', 'action' => 'index'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        <p>
                            Reservas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> <p>Adicionar</p>', ['controller' => 'reservas', 'action' => 'add'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="far fa-list-alt nav-icon"></i> <p>Listar</p>', ['controller' => 'reservas', 'action' => 'index'], ['escape' => false,  'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-sign-out-alt" aria-hidden="true"></i> <p> Sair</p>', ['controller' => 'users', 'action' => 'logout'], ['escape' => false,  'class' => 'nav-link']) ?>
                </li>
            </ul>
        </nav>
    </div>
</aside>