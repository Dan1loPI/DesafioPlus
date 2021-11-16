<?php

use Cake\I18n\Date;
?>
</section>
<section class="content mt-2">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-table"></i> Relatórios de Clientes</h3>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 36%">
              Tipos de relatórios
            </th>
            <th style="width: 54%">
            </th>
            <th style="width: 5%">
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <a>
                Quantidade de reservas feita por dia no ultimo mês.
              </a>
              <br />
            </td>
            <td></td>
            <td class="project-actions text-right">
              <?php if ($arquivo) : ?>
                <?= $this->Html->link('Download ', '/relatorios/clientes/Relatorio.xlsx' , ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
              <?php else : ?>
                <?= $this->Html->link('Gerar Relatório', ['controller' => 'relatorios', 'action' => 'exportClientes'], ['class' => 'btn btn-sm  btn-success', 'escape' => false]) ?>
              <?php endif ?>
            </td>
          </tr>
          <tr>
            <td>
              <a>
                Quantidade de reserva por data.
              </a>

            </td>
            <td>
              <?= $this->Form->create(null,['url'=> ['action' => 'exportClientesData',], 'type'=>'get']) ?>
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
                <?= $this->Html->link('Download ', '/relatorios/clientes/data/Relatorio.xlsx', ['download' => 'Relatorio.xlsx', 'class' => 'btn btn-sm btn-success']) ?>
                <?php endif ?>

                
            </td>
          </tr>
        </tbody>
      </table>
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