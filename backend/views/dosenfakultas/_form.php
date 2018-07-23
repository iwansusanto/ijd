<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dosen;
use app\models\Fakultas;
use app\models\TahunAjaran;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Dosenfakultas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosenfakultas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dosen_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Dosen::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Dosen'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'fakultas_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Fakultas::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Fakultas'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'tahun_ajaran_id')
                ->hiddenInput(['value' => Yii::$app->is->tahunajaran()->id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
