<?php

use app\models\Buku;
use app\models\Peminjaman;
use app\models\Pengembalian;

$this->title = 'Dashboard';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'theme' => 'success',
                'text' => 'Buku',
                'number' => Buku::find()->count(),
                'icon' => 'fas fa-book',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'theme' => 'info',
                'text' => 'Peminjaman',
                'number' => \Yii::$app->user->can('admin')? Peminjaman::find()->sum('qty') : Peminjaman::find()->where(['user_id' => \Yii::$app->user->identity->id])->sum('qty'),
                'icon' => 'fas fa-book',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'theme' => 'warning',
                'text' => 'Pengembalian',
                'number' => \Yii::$app->user->can('admin')? Pengembalian::find()->sum('qty') : Pengembalian::find()->where(['user_id' => \Yii::$app->user->identity->id])->sum('qty'),
                'icon' => 'fas fa-book',
            ]) ?>
        </div>
    </div>
</div>