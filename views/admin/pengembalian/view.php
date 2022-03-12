<?php

use app\models\Pengembalian;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detail Pengembalian';
\yii\web\YiiAsset::register($this);
?>
<div class="pengembalian-view">
    <?php if (\Yii::$app->user->can('admin')) : ?>
        <p>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Peminjam',
                'value' => $model->user->nama
            ],
            'buku.judul',
            'buku.pengarang',
            'buku.tahun_terbit',
            'qty',
            [
                'label' => 'Admin',
                'value' => $model->admin->nama
            ],
            'at',
        ],
    ]) ?>

</div>