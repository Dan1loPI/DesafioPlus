 <nav class="main-header navbar navbar-expand navbar-white navbar-light">

     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <?= $this->Html->link('Inicio', ['controller' => 'welcome', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link']) ?>
         </li>
     </ul>


     <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="fa fa-cog" aria-hidden="true"></i>
                 <b>Opções</b>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <?= $this->Html->link('<i class="far fa-user" aria-hidden="true"></i> Perfil</p>', ['controller' => 'users', 'action' => 'perfil'], ['escape' => false,  'class' => 'nav-link']) ?>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <?= $this->Html->link('<i class="fas fa-sign-out-alt" aria-hidden="true"></i> Sair</p>', ['controller' => 'users', 'action' => 'logout'], ['escape' => false,  'class' => 'nav-link']) ?>

                 </a>
             </div>
         </li>
     </ul>
 </nav>