<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Create Buku';
// $this->params['breadcrumbs'][] = ['label' => 'Bukus', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
