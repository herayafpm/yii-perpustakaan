<?php

use yii\helpers\Html;
use yii\helpers\Url;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title ?? 'Login') ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition login-page">
    <?php $this->beginBody() ?>
    <div class="login-box" id="appVue">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= Url::base() ?>" class="h1"><?= Yii::$app->params['APP_NAME'] ?></a>
            </div>
            <div class="card-body">
                <?= $content ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>