<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModuleTahunAjaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-tahun-ajaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_id')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_ajaran_id')->textInput() ?>

    <?= $form->field($model, 'periode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_sks')->textInput() ?>

    <?= $form->field($model, 'jumlah_menit_per_sks')->textInput() ?>

    <?= $form->field($model, 'user_created')->textInput() ?>

    <?= $form->field($model, 'user_updated')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
