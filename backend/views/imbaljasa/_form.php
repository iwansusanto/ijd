<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImbalJasa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imbal-jasa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tgl_kegiatan')->textInput() ?>

    <?= $form->field($model, 'dosen_fakultas_id')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput() ?>

    <?= $form->field($model, 'nama_dosen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_fakultas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dosen_fakultas_id_pengganti')->textInput() ?>

    <?= $form->field($model, 'nip_pengganti')->textInput() ?>

    <?= $form->field($model, 'nama_dosen_pengganti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_fakultas_pengganti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module_kelas_id')->textInput() ?>

    <?= $form->field($model, 'module_id')->textInput() ?>

    <?= $form->field($model, 'nama_module')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelas_id')->textInput() ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruangan_id')->textInput() ?>

    <?= $form->field($model, 'nama_ruangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jam_mulai')->textInput() ?>

    <?= $form->field($model, 'jam_selesai')->textInput() ?>

    <?= $form->field($model, 'peran_hitung_id')->textInput() ?>

    <?= $form->field($model, 'peran_id')->textInput() ?>

    <?= $form->field($model, 'nama_peran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_created')->textInput() ?>

    <?= $form->field($model, 'user_updated')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
