<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admnistrativo</title>

    <?= $this->Html->css(['bootstrap', 'login', 'all.min']); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('js') ?>

</head>
<body class="hold-transition login-page">

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<?= $this->Html->script(['jquery.min', 'jquery-ui.min', 'bootstrap.bundle.min']); ?>
</body>
</html>