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
<section>
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <div class="callout callout-info">
          <div class="row">
            <div class="col-8">
              Cadastrados :
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdClientes ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              Ativos :
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdClientesAtivos ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              Inativos:
            </div>
            <div class="col-4">
              <p class="text-orange "><?= $qtdClientesInativos ?></p>
            </div>
          </div>
        </div>
      </div>
    
    
      <div class="col-6">
        <div class="card">
          <div class="card-header border-0">
            
            Top 5 maiores clientes
          </div>
          <table>
            <tbody>
              <?php foreach ($topCincoClientes as $cliente) : ?>
                <tr>
                  <td><?= $cliente->cliente->nome ?></td>
                  <td class="text-orange"><?= $cliente->qtd_reservas ?><br></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</section>
</div>
<script>
  $(function() {
    $(".datepicker").datepicker({
      'dateFormat': 'dd-mm-yy'
    });
  });
</script>