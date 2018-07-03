<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TahunAjaran;
use kartik\date\DatePicker;
use app\models\Module;
use kartik\select2\Select2;
use app\models\Peran;
use kartik\number\NumberControl;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $model app\models\PeranHitung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peran-hitung-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tahun_ajaran_id')
                ->dropDownList(ArrayHelper::map(TahunAjaran::find()->asArray()->all(), 'id', 'periode'),
                        ['value' =>  Yii::$app->is->tahunajaran()->id]) ?>
            
            <?= $form->field($model, 'bulan')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select Month'],
                    'readonly'  =>  true,
                    'pluginOptions' => [
                        'viewMode' => 'months',
                        'minViewMode' => 'months',
                        'format' => 'yyyy-mm',
                        'autoclose' => true,
                    ]
                ]); ?>
            
            <?= $form->field($model, 'module_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Module::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Module'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
            
            <?= $form->field($model, 'peran_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Peran::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Peran'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
            
            <?= $form->field($model, 'honor_menit_hitung')
                        ->widget(NumberControl::className(), [
                            'maskedInputOptions' => Yii::$app->params['maskInputOptions'],
                            'options' => Yii::$app->params['saveOptions'],
                            'displayOptions' => Yii::$app->params['dispOptions'],
                            'saveInputContainer' => Yii::$app->params['saveCont']
                    ]) ?>
            
            <?= $form->field($model, 'transport_hitung')
                        ->widget(NumberControl::className(), [
                            'maskedInputOptions' => Yii::$app->params['maskInputOptions'],
                            'options' => Yii::$app->params['saveOptions'],
                            'displayOptions' => Yii::$app->params['dispOptions'],
                            'saveInputContainer' => Yii::$app->params['saveCont']
                    ]) ?>

            
        </div>
        <div class="col-md-6">
            
            <?= $form->field($model, 'jumlah_sks')->widget(TouchSpin::className(),[
                    'readonly'  =>  true,
                               'pluginOptions' => [
                                   'min' => 1,
                                   'max' => 150,
                                   'step' => 1,
                                   'verticalbuttons' => true,
                                   'verticalupclass' => 'glyphicon glyphicon-plus',
                                   'verticaldownclass' => 'glyphicon glyphicon-minus',
                               ]
            ]) ?>
            
            <?= $form->field($model, 'jumlah_menit_per_sks')->widget(TouchSpin::className(), [
                    'readonly'  =>  true,
                               'pluginOptions' => [
                                   'min' => 50,
                                   'max'    =>  3600,
                                   'step' => 10,
                                   'verticalbuttons' => true,
                                   'verticalupclass' => 'glyphicon glyphicon-plus',
                                   'verticaldownclass' => 'glyphicon glyphicon-minus',
                               ]
            ]) ?>

            <?= $form->field($model, 'volume_menit_pertemuan')->widget(TouchSpin::className(), [
                    'readonly'  =>  true,
                               'pluginOptions' => [
                                   'min' => 2,
                                   'max'    =>  24,
                                   'step' => 1,
                                   'verticalbuttons' => true,
                                   'verticalupclass' => 'glyphicon glyphicon-plus',
                                   'verticaldownclass' => 'glyphicon glyphicon-minus',
                               ]
            ]) ?>    

            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
            
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            
        </div>
    </div>

   

    

    

    <?php ActiveForm::end(); ?>

</div>
