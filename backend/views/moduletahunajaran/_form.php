<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TahunAjaran;
use yii\helpers\ArrayHelper;
use app\models\Module;
use kartik\select2\Select2;
use kartik\touchspin\TouchSpin;
use app\models\Semester;

/* @var $this yii\web\View */
/* @var $model app\models\ModuleTahunAjaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-tahun-ajaran-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'tahun_ajaran_id')
                ->hiddenInput(['value' => Yii::$app->is->tahunajaran()->id])->label(false); ?>
    <?php else: ?>
        <?= $form->field($model, 'tahun_ajaran_id')
                ->dropDownList(ArrayHelper::map(TahunAjaran::find()->asArray()->all(), 'id', 'periode'),
                        ['value' =>  Yii::$app->is->tahunajaran()->id]) ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'semester_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Semester::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Semester'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'module_id')
                ->widget(Select2::className(), [
                            'data'      =>  ArrayHelper::map(Module::find()->asArray()->all(), 'id', 'nama'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Module'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ]]) ?>
    
    <?= $form->field($model, 'jumlah_sks')->widget(TouchSpin::className(),[
                    'readonly'  =>  true,
                               'pluginOptions' => [
                                   'min' => 1,
                                   'max' => 150,
                                   'step' => 1,
                                   'verticalbuttons' => true,
                                   'verticalup' => '<small><i class="glyphicon glyphicon-plus"></i></small>',
                                   'verticaldown' => '<small><i class="glyphicon glyphicon-minus"></i></small>'
//                                   'verticalupclass' => 'glyphicon glyphicon-plus',
//                                   'verticaldownclass' => 'glyphicon glyphicon-minus',
                               ]
            ]) ?>
    
    <?= $form->field($model, 'jumlah_menit_per_sks')->widget(TouchSpin::className(), [
                    'readonly'  =>  true,
                               'pluginOptions' => [
                                   'min' => 50,
                                   'max'    =>  3600,
                                   'step' => 10,
                                   'verticalbuttons' => true,
                                   'verticalup' => '<small><i class="glyphicon glyphicon-plus"></i></small>',
                                   'verticaldown' => '<small><i class="glyphicon glyphicon-minus"></i></small>'
//                                   'verticalupclass' => 'glyphicon glyphicon-plus',
//                                   'verticaldownclass' => 'glyphicon glyphicon-minus',
                               ]
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

// print_r(ArrayHelper::merge(
//         [
//             '1'   => 'Select Option'
//         ], ArrayHelper::map(Module::find()->asArray()->all(), 'id', 'nama')));