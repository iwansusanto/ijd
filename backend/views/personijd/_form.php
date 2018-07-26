<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Dosen;
use app\models\Jabatan;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personijd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personijd-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'tahun_ajaran_id')
                ->hiddenInput(['value' => Yii::$app->is->tahunajaran()->id])->label(false); ?>
    
    <?= $form->field($model, 'dosen_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Dosen::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Name'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>

    <?= $form->field($model, 'jabatan_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Jabatan::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Jabatan'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>


    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), []); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
