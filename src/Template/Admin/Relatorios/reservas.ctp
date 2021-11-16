<section class="content mt-2">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-table"></i> Relatórios de Reservas</h3>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>

            <th style="width: 50%">
              Tipos de relatorio
            </th>

          
          </tr>
        </thead>
        <tbody>
          <tr>

            <td>
              <a>
                Quantidade de reservas feita por dia no ultimo mês
              </a>
            </td>
            <td class="project-actions text-right">
              <?php if ($arquivo) : ?>
                <?= $this->Html->link('Download ', '/relatorios/reservas/Relatorio.xlsx', ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
              <?php else : ?>
                <?= $this->Html->link('Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportReservas'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
              <?php endif ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
<section>
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
</script>