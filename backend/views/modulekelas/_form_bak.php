<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Module;
use app\models\Kelas;
use app\models\TahunAjaran;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ModuleKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Module::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Module'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    
    <?= $form->field($model, $model->isNewRecord ? 'kelas_id[]' : 'kelas_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Kelas::find()->asArray()->all(), 'id', 'nama'),
                            'maintainOrder' => true,
                            'options'   =>  [
                                'placeholder'  =>  'Select Kelas',
                                'multiple' => $model->isNewRecord ? true : false],
                            'pluginOptions' =>  [
                                'tags' => $model->isNewRecord ? true : false,
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'tahun_ajaran_id')
                ->dropDownList(ArrayHelper::map(TahunAjaran::find()->asArray()->all(), 'id', 'periode'),
                        ['value' =>  Yii::$app->is->tahunajaran()->id]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
