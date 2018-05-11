<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TahunAjaran;
use kartik\select2\Select2;
use app\models\Module;
use app\models\Peran;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeranHitungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peran Hitungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peran-hitung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peran Hitung', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'tahun_ajaran_id',
                'value' => 'tahunAjaran.periode',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'tahun_ajaran_id',
                                'data'      =>  ArrayHelper::map(TahunAjaran::find()->asArray()->all(), 'id', 'periode'),
                                'options'   =>  ['placeholder'  =>  'Select Tahun Ajaran'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
            [
                'attribute' => 'bulan',
                'label' => 'Bulan',
                'value' => function($model){
                    return Yii::$app->is->bulan($model->bulan).' '.$model->tahun;
                },
                'filter' => Select2::widget([
                        'model' =>  $searchModel,
                        'attribute'      =>  'bulan',
                        'data'      =>  Yii::$app->is->bulan(),
                        'options'   =>  ['placeholder'  =>  'Select Bulan'],
                        'pluginOptions' =>  ['allowClear'    =>  true]])],
            [
                'attribute' => 'module_id',
                'value' => 'module.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'module_id',
                                'data'      =>  ArrayHelper::map(Module::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Module'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
            [
                'attribute' => 'peran_id',
                'value' => 'peran.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'peran_id',
                                'data'      =>  ArrayHelper::map(Peran::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Peran'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
            //'tahun',
            //'jumlah_sks',
            //'jumlah_menit_hitung',
            [
                'attribute' =>'honor_menit_hitung',
                'format'=> ['roundedCurrency', 'Rp. '],
            ],            
            //'jumlah_menit_per_sks',
            //'volume_menit_pertemuan',
            //'keterangan:ntext',
            //'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
