<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-table"></i>Relatórios de Usuário</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Relatórios</li>
          <li class="breadcrumb-item active">Usuário</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="callout callout-info">
          <div class="row">
            <div class="col-10">
              Total de reservas agendadas por você :
            </div>
            <div class="col-2">
              <p class="text-orange "><?= $qtdReservasAgendadas ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-10">
              Total de reservas canceladas por você :
            </div>
            <div class="col-2">
              <p class="text-orange "><?= $qtdReservasCanceladas ?></p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <section class="content pb-3">
  <div class="col-4">
    <div class="container-fluid h-100">
      <div class="card card-row card-secondary">
        <div class="card-header">
          <h3 class="card-title">
            Top 05 Funcionarios
          </h3>
        </div>
        <div class="card-body">
          <?= $this->Html->link('<i class="fas fa-download"></i> Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportFuncionarios'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
        </div>
      </div>
    </div>
  </div>
</section>
</section>
