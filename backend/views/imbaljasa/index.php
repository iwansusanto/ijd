<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImbalJasaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imbal Jasas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imbal-jasa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Imbal Jasa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'tgl_kegiatan',
//            'dosen_fakultas_id',
//            'nip',
            'nama_dosen',
            //'nama_fakultas',
            //'dosen_fakultas_id_pengganti',
            //'nip_pengganti',
            'nama_dosen_pengganti',
            //'nama_fakultas_pengganti',
            //'module_kelas_id',
            //'module_id',
            //'nama_module',
            //'kelas_id',
            //'nama_kelas',
            //'ruangan_id',
            //'nama_ruangan',
            'jam_mulai',
            'jam_selesai',
            //'peran_hitung_id',
            //'peran_id',
            //'nama_peran',
            //'keterangan:ntext',
            //'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
