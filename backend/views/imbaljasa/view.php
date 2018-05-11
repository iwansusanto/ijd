<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImbalJasa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Imbal Jasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imbal-jasa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tgl_kegiatan',
            'dosen_fakultas_id',
            'nip',
            'nama_dosen',
            'nama_fakultas',
            'dosen_fakultas_id_pengganti',
            'nip_pengganti',
            'nama_dosen_pengganti',
            'nama_fakultas_pengganti',
            'module_kelas_id',
            'module_id',
            'nama_module',
            'kelas_id',
            'nama_kelas',
            'ruangan_id',
            'nama_ruangan',
            'jam_mulai',
            'jam_selesai',
            'peran_hitung_id',
            'peran_id',
            'nama_peran',
            'keterangan:ntext',
            'user_created',
            'user_updated',
            'update_time',
        ],
    ]) ?>

</div>
