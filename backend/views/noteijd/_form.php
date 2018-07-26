<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Noteijd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noteijd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun_ajaran_id')
                ->hiddenInput(['value' => Yii::$app->is->tahunajaran()->id])->label(false); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'no_urut')
                ->widget(Select2::className(), [
                            'data'      =>  $no_urut,
                            'options'   =>  [
                                'placeholder'  =>  'Select No Urut',
                                'options'   =>  $disable_value
                            ],
                            'pluginOptions' =>  [
//                                'allowClear'    =>  true
                            ]]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
