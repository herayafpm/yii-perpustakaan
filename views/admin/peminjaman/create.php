<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tambah Peminjaman';
?>
<div class="peminjaman-create">

    <div class="peminjaman-form">

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $listData = ArrayHelper::map($bukus, 'id', 'judul');
        echo $form->field($model, 'buku_id')->dropDownList($listData, ['prompt' => 'Pilih Buku...'])->label('Buku');
        ?>
        <?php
        $listData = ArrayHelper::map($users, 'id', 'nama');
        echo $form->field($model, 'user_id')->dropDownList($listData, ['prompt' => 'Pilih Pengguna...'])->label('Pengguna');
        ?>
        <?= $form->field($model, 'qty')->textInput(['type' => 'number']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>