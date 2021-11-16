<?php

use Cake\I18n\Date;
?>

<section class="content mt-2">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-table"></i> Relatórios de Mesas</h3>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 30%">
              Tipos de relatórios
            </th>

            <th style="width: 55%">
            </th>
           
            <th style="width: 5%">
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              Quantidade de reservas recebidas por mesa.
            </td>
            <td >
              <?= $this->Form->create(null,['url'=> ['action' => 'mesas',], 'type'=>'get']) ?>
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
              <?php if ($arquivo) : ?>
                <?= $this->Html->link('Download ', '/relatorios/mesas/Relatorio.xlsx', ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
              <?php else : ?>
                <?= $this->Html->link('Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportMesas'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
              <?php endif ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid h-100">
    <div class="row">

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