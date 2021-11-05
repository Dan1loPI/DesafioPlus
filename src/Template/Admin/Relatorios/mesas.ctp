<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-table"></i>Relatórios de Mesas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Relatórios</li>
          <li class="breadcrumb-item active">Mesas</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header border-0">
        <div class="row ">
          <?= $this->Form->create(null, ['type' => 'get']) ?>
          <div class="row">
            <label for="data_inicio">De</label>
            <?= $this->Form->control('data_inicio', ['class' => 'datepicker form-control col-6', 'autocomplete' => 'off', 'value' => $this->request->query('data_inicio'), 'label' => false]) ?>
            <label for="data_inicio">Até</label>
            <?= $this->Form->control('data_fim', ['class' => 'datepicker form-control col-6', 'autocomplete' => 'off', 'value' => $this->request->query('data_fim'),  'label' => false]) ?>
            <button>Procurar</button>
          </div>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="row">
            <h3 class="card-title">Quantidade de reserva por mesa</h3>
          </div>
          <div class="float-sm-right ">
            <?= $this->Html->link('<i class="fas fa-download"></i> Download.xls', ['controller' => 'relatorios', 'action' => 'exportMesas'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
          </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
                <tr>
                  <th><?= $this->Paginator->sort('Nº MESA'); ?></th>
                  <th><?= $this->Paginator->sort('QUANTIDADE RESERVAS') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($reservasPorMesa as $mesa) : ?>
                  <tr>
                    <td><?= 'Mesa :' . $mesa['mesa']['num_mesa'] ?></td>
                    <td class="text-center"><?= $mesa['teste'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <div class="row">
              Total de Mesas Reservadas :
              <div class="text-right">
                <p class="text-orange"><?= $sumTotalMesa->somaReserva ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="callout callout-info">
          <div class="row">
            <div class="col-8">
              Cadastradas :
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdMesas ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              Ativas :
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdMesasAtivas ?></p>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              Inativas:
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdMesasInativas ?></p>
            </div>
          </div>
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