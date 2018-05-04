<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\TahunAjaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tahun-ajaran-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= Html::label('Periode'); ?>
    <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'periode_awal',
            'attribute2' => 'periode_akhir',
            'options' => ['placeholder' => 'Periode Awal'],
            'options2' => ['placeholder' => 'Periode Akhir'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
//                'stepping' => 30,
                'viewMode' => 'months',
                'minViewMode' => 'months',
                'format' => 'yyyy-mm',
                'autoclose' => true,
            ]
        ]);?>

    <?= $form->field($model, 'periode')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::className(), []); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
