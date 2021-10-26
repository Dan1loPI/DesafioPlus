<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Desafio</b>Norven</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Faça login para iniciar sua sessão</p>

            <?= $this->Form->create('post') ?>

            <div class="input-group mb-3">
            <?= $this->Form->control('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => false]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">

                <?= $this->Form->control('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'label' => false]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Lembrar - me
                        </label>
                    </div>
                </div>
                <div class="col-5">
                    <?= $this->Form->button(__('Acessar'), ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>

            <?= $this->Form->end() ?>
            <?= $this->Flash->render(); ?>
        </div>
    </div>
</div>