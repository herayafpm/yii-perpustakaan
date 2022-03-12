<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <input id="admin" type="checkbox" class="form-checkbox" value="1" name="admin" <?= $authManager->checkAccess($model->id,'admin') ?'checked':'' ?>>
        <label class="control-label" for="admin">Admin</label>
        <div class="help-block"></div>
    </div>
    <div class="form-group">
        <input id="user" type="checkbox" class="form-checkbox" value="1" name="user" <?= $authManager->checkAccess($model->id,'user') ?'checked':'' ?>>
        <label class="control-label" for="user">User</label>
        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>