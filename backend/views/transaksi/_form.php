<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Semester;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bulan_tahun')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select Month'],
                    'readonly'  =>  true,
                    'disabled'  => $model->isNewRecord ? false : true,
                    'pluginOptions' => [
                        'viewMode' => 'months',
                        'minViewMode' => 'months',
                        'format' => 'yyyy-mm',
                        'autoclose' => true,
                    ]
                ]); ?>
    
    <?= $form->field($model, 'tahun_ajaran_id')->hiddenInput()->label(false); ?>
    
    <?= $form->field($model, 'semester_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Semester::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Semester'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
