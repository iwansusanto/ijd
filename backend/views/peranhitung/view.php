<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PeranHitung */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peran Hitung', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peran-hitung-view">

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
            'peran_id',
            'module_id',
            'tahun_ajaran_id',
            'bulan',
            'tahun',
            'jumlah_sks',
            'jumlah_menit_hitung',
            'honor_menit_hitung',
            'transport_hitung',
            'jumlah_menit_per_sks',
            'volume_menit_pertemuan',
            'keterangan:ntext',
            'user_created',
            'user_updated',
            'update_time',
        ],
    ]) ?>

</div>
