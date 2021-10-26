<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admnistrativo</title>

    <?= $this->Html->css([
        'adminlte', 'all.min', 'select2.min', 'select2-bootstrap4.min',
        'dataTables.bootstrap4.min',
        'responsive.bootstrap4.min',
        'buttons.bootstrap4.min'
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('js') ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?= $this->element('cabecalho') ?>

        <?= $this->element('menu') ?>

        <div class="content-wrapper">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>
    <?= $this->Html->script([
        'jquery.min', 'jquery-ui.min', 'bootstrap.bundle.min', 'adminlte', 'dashboard', 'select2.full.min.js',
        
        'dataTables.bootstrap4.min',
        
        
        'dataTables.buttons.min',
        'buttons.bootstrap4.min',
        'jszip.min',
        'pdfmake.min',
        'vfs_fonts',
        'buttons.html5.min',
        'buttons.print.min'
    ]) ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
        
    </script>
</body>

</html>