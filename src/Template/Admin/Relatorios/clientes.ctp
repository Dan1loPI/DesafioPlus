<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-table"></i> Relatórios de Clientes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Relatórios</li>
          <li class="breadcrumb-item active">Clientes</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content pb-3">
  <div class="col-3">
    <div class="container-fluid h-100">
      <div class="card card-row card-secondary">
        <div class="card-header">
          <h3 class="card-title">
            Top 10 Clientes do ultimo mês
          </h3>
        </div>
        <div class="card-body">
          <?= $this->Html->link('<i class="fas fa-download"></i> Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportClientes'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(function() {
    $(".datepicker").datepicker({
      'dateFormat': 'dd-mm-yy'
    });
  });
</script>