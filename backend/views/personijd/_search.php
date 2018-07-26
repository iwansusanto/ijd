<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonijdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personijd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dosen_id') ?>

    <?= $form->field($model, 'jabatan_id') ?>

    <?= $form->field($model, 'tahun_ajaran_id') ?>

    <?= $form->field($model, 'nip') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'user_created') ?>

    <?php // echo $form->field($model, 'user_updated') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
