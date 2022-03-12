<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Update Buku';
// $this->params['breadcrumbs'][] = ['label' => 'Bukus', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="buku-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
