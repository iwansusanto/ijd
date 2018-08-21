<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peran-index">

    <h1><?= Html::encode($this->title).Html::tag('i', '', [
                'class' =>  'fa fa-question-circle-o',
                'aria-hidden'   => 'true',
                'data-title'=>'Info',
                'data-content'=>'Untuk mengaktifkan peran agar dapat digunakan di saat proses transaksi'
                                 . ' maka silahkan tentukan peran yang akan digunakan untuk tiap tiap bulan melalui menu Transaksi -> Hitung Peran',
                'data-toggle'=>'popover',
                'style'=>'margin-left: 10px; font-size: 20px; cursor:pointer;'
            ]) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'nama',
//            'keterangan:ntext',
//            'user_created',
//            'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
