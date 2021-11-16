<?php

use Cake\I18n\Date;
?>
<section class="content mt-2">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-table"></i> Relatórios de Usuários</h3>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 26%">
              Tipos de relatório
            </th>
            <th style="width: 50%"></th>
            <th style="width: 6%"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <a>
              Top 10 Funcionários que mais reservaram mesas geral.
              </a>
            </td>
            <td></td>
            <td class="project-actions text-right">
              <?php if ($arquivo) : ?>
                <?= $this->Html->link('Download ', '/relatorios/users/Relatorio.xlsx', ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
              <?php else : ?>
                <?= $this->Html->link('<i class="fas fa-download"></i> Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportFuncionarios'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
              <?php endif ?>
            </td>
          </tr>
          <tr>
            <td>
              <a>
                Filtro por data.
              </a>
            </td>
            
            <td>
              <?= $this->Form->create(null,['url'=> ['action' => 'exportFuncionariosData',], 'type'=>'get']) ?>
              <div class="row">
                <label for="data_inicio">De</label>
                <?= $this->Form->control('data_inicio', ['class' => 'datepicker form-control  ', 'autocomplete' => 'off', 'value' => date_format(Date::now(), 'd-m-Y'), 'label' => false]) ?>
                <label for="data_inicio">Até</label>
                <?= $this->Form->control('data_fim', ['class' => 'datepicker form-control ', 'autocomplete' => 'off', 'value' =>  date_format(Date::now(), 'd-m-Y'),  'label' => false]) ?>
                <button class="btn btn-success btn-sm">Gerar</button>
              </div>
              <?= $this->Form->end() ?>
            </td>
            <td class="project-actions text-right">
              <?php if($arquivoData): ?>
                <?= $this->Html->link('Download ', '/relatorios/users/data/Relatorio.xlsx', ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
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
</section>
<script>
  $(function() {
    $(".datepicker").datepicker({
      'dateFormat': 'dd-mm-yy'
    });
  });
</script>