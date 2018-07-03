<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaksi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'no_transaksi',
//            'tgl_transaksi',
            [
                'attribute' => 'bulan_tahun',
                'label' => 'Bulan',
                'value' => function($model){
//                    return Yii::$app->is->bulan(date('m', strtotime($model->bulan_tahun))).' '.date('Y', strtotime($model->bulan_tahun));
                    return Yii::$app->is->bulan((int)date('m', strtotime($model->bulan_tahun))).' '.date('Y', strtotime($model->bulan_tahun));
                },
                'filter' => Select2::widget([
                        'model' =>  $searchModel,
                        'attribute'      =>  'bulan_tahun',
                        'data'      =>  Yii::$app->is->bulan(),
                        'options'   =>  ['placeholder'  =>  'Select Bulan'],
                        'pluginOptions' =>  ['allowClear'    =>  true]])],
            'keterangan:ntext',
            //'user_created',
            //'user_updated',
            //'update_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {hitungimbaljasa}',
                'buttons' => [
                    'hitungimbaljasa' => function($url, $model, $key) {     // render your custom button
                        return Html::a('&nbsp;<span class="fa fa-calculator"></span>', ['transaksi/imbaljasa', 'id' =>  $model->id], [
                                            'title' => 'Hitung', 
                                            'aria-label' => 'Hitung', 
                                            'data-pjax' => 0]);
                    }
                ]],
        ],
    ]); ?>
</div>
