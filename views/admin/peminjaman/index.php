<?php

use app\models\Peminjaman;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index">
    <?php if(\Yii::$app->user->can('admin')):?>
    <p>
        <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif;?>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'user_nama',
                'label' => 'Peminjam',
                'format' => 'raw',
                'value' => function($data){
                    return $data->user->nama;
                }
            ],
            [
                'attribute' => 'judul',
                'format' => 'raw',
                'value' => function($data){
                    return $data->buku->judul;
                }
            ],
            [
                'attribute' => 'admin_nama',
                'label' => 'Admin',
                'format' => 'raw',
                'value' => function($data){
                    return $data->admin->nama;
                }
            ],
            'qty',
            'at:datetime',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}{delete}',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return \Yii::$app->user->can('admin');
                        }
                    ],
                'urlCreator' => function ($action, Peminjaman $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>