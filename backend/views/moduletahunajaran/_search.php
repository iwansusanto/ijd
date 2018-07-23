<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModuleTahunAjaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-tahun-ajaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tahun_ajaran_id') ?>

    <?= $form->field($model, 'periode') ?>

    <?php // echo $form->field($model, 'jumlah_sks') ?>

    <?php // echo $form->field($model, 'jumlah_menit_per_sks') ?>

    <?php // echo $form->field($model, 'user_created') ?>

    <?php // echo $form->field($model, 'user_updated') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
