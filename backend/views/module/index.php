<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-index">

    <h1><?= Html::encode($this->title).Html::tag('i', '', [
                'class' =>  'fa fa-question-circle-o',
                'aria-hidden'   => 'true',
                'data-title'=>'Info',
                'data-content'=>'Untuk mengaktifkan modul agar dapat digunakan saat proses transaksi '
                                . 'maka silahkan tentukan modul per semester melalui menu Tahun Ajaran -> Module dan Tahun Ajaran',
                'data-toggle'=>'popover',
                'style'=>'margin-left: 10px; font-size: 20px; cursor:pointer;'
            ]) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Module', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'nama',
            'keterangan:ntext',
//            'user_created',
//            'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
