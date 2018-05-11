<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImbalJasaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imbal-jasa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl_kegiatan') ?>

    <?= $form->field($model, 'dosen_fakultas_id') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nama_dosen') ?>

    <?php // echo $form->field($model, 'nama_fakultas') ?>

    <?php // echo $form->field($model, 'dosen_fakultas_id_pengganti') ?>

    <?php // echo $form->field($model, 'nip_pengganti') ?>

    <?php // echo $form->field($model, 'nama_dosen_pengganti') ?>

    <?php // echo $form->field($model, 'nama_fakultas_pengganti') ?>

    <?php // echo $form->field($model, 'module_kelas_id') ?>

    <?php // echo $form->field($model, 'module_id') ?>

    <?php // echo $form->field($model, 'nama_module') ?>

    <?php // echo $form->field($model, 'kelas_id') ?>

    <?php // echo $form->field($model, 'nama_kelas') ?>

    <?php // echo $form->field($model, 'ruangan_id') ?>

    <?php // echo $form->field($model, 'nama_ruangan') ?>

    <?php // echo $form->field($model, 'jam_mulai') ?>

    <?php // echo $form->field($model, 'jam_selesai') ?>

    <?php // echo $form->field($model, 'peran_hitung_id') ?>

    <?php // echo $form->field($model, 'peran_id') ?>

    <?php // echo $form->field($model, 'nama_peran') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'user_created') ?>

    <?php // echo $form->field($model, 'user_updated') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
