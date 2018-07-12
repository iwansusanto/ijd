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

    <?php $form = ActiveForm::begin([
                    'id'    =>  'form-dosenfakultas',
                    'enableClientValidation' => false, 
                    'enableAjaxValidation' => false,    
                    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    
    <div class="wrapper-dosen">
    <?php foreach ($model as $i=>$row): ?>
    
        <div class="row row-dosen" id="cd-<?= $i; ?>" data-count="<?= $i; ?>">
            
            <div class="col-md-4"><?= $form->field($row, "[$i]dosen_id")
                                        ->widget(Select2::className(), [
                                                    'data'      =>  ArrayHelper::map($dosen, 'id', 'nama'),
                                                    'options'   =>  [
                                                        'placeholder'  =>  'Select Dosen',
                                                        'value' =>  $row->dosen_id],
                                                    'pluginOptions' =>  [
                                                        'allowClear'    =>  true
                                                    ]]) ?>
            </div>
            <div class="col-md-4"><?= $form->field($row, "[$i]fakultas_id")
                                        ->widget(Select2::className(), [
                                                    'data'      =>  ArrayHelper::map($fakultas, 'id', 'nama'),
                                                    'options'   =>  [
                                                        'placeholder'  =>  'Select Fakultas',
                                                        'value' =>  $row->fakultas_id],
                                                    'pluginOptions' =>  [
                                                        'allowClear'    =>  true
                                                    ]]) ?>
            </div>
            <div class="col-md-4"><?= Html::button('Delete', [
                    'class' =>  'btn btn-danger btn-delete',
                    'style' =>  'margin: 25px; 0px; 0px; 30px;'
            ]); ?>
                
            </div>
        </div>
    
    <?php endforeach; ?>
    </div>
    
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <?= Html::button('Add Dosen', [
                            'class' => 'btn btn-primary btn-block add-dosen',
                            'data-loading-text' =>  'Loading...']) ?>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block btn-save']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJsFile(
    '@web/script/form_templatedosenfakultas.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>