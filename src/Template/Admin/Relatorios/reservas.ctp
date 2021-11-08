<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-table"></i>Relatórios de Reservas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Relatórios</li>
          <li class="breadcrumb-item active">Reservas</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section>
 
    <div class="card card-default">
      <div class="card-header border-0">
      <div class="float-sm-right ">
            <?= $this->Html->link('<i class="fas fa-download"></i> Download.xls', ['controller' => 'relatorios', 'action' => 'exportReservas'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
          </div>
        <div class="row ">
          <?= $this->Form->create(null, ['type' => 'get']) ?>
          <div class="row">
            <label for="data_inicio">De</label>
            <?= $this->Form->control('data_inicio', ['class' => 'datepicker form-control col-8', 'autocomplete' => 'off', 'value' => $this->request->query('data_inicio'), 'label' => false]) ?>
            <label for="data_inicio">Até</label>
            <?= $this->Form->control('data_fim', ['class' => 'datepicker form-control col-8', 'autocomplete' => 'off', 'value' => $this->request->query('data_fim'),  'label' => false]) ?>
            <button>Procurar</button>
          </div>
          <?= $this->Form->end() ?>
        </div>
      </div>


      <div class="row">
        <div class="card-body">
          <table id="teste" class="table table-striped table-valign-middle">
            <thead>
              <tr>
                <th class="text-orange"><?= $this->Paginator->sort('ID') ?></th>
                <th class="text-orange"><?= $this->Paginator->sort('CLIENTE') ?></th>
                <th class="text-orange"><?= $this->Paginator->sort('Nº MESA') ?></th>
                <th class="text-center text-orange"><?= $this->Paginator->sort('DATA DA RESERVA') ?></th>
                <th class="text-orange"><?= $this->Paginator->sort('STATUS') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($filtroReserva as $reserva) : ?>
                <tr>
                  <td><?= $this->Number->format($reserva->id) ?></td>
                  <td><?= $reserva->cliente->nome ?></td>
                  <td><?= $reserva->mesa->num_mesa ?></td>
                  <td class="text-center"><?= $reserva->data_reserva ?></td>
                  <td><?= $reserva->status ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <?= $this->element('pagination'); ?>
        </div>
      </div>
    </div>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-5">
        <div class="callout callout-info">
          <div class="row">
            <div class="col-10">
              Total de reservas finalizadas :
            </div>
            <div class="col-2">
              <p class="text-orange "><?= $qtdReservasFinalizadas ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-10">
              Total de reservas canceladas :
            </div>
            <div class="col-2">
              <p class="text-orange "><?= $qtdReservasCanceladas ?></p>
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
  $(document).ready(function() {
    $('#teste').DataTable( {
        dom: 'Bfrtip',
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        buttons: [
            'excel'
        ]
    } );
} );

</script>
