<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Dosen;
use app\models\TahunAjaran;
use app\models\Fakultas;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DosenfakultasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosenfakultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosenfakultas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dosenfakultas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'attribute' => 'dosen_id',
                'value' => 'dosen.nama',
//                'filter' => Html::activeDropDownList($searchModel, 'dosen_id', ArrayHelper::map(Dosen::find()->asArray()->all(), 'id', 'nama'),
//                                ['class'=>'form-control','prompt' => 'Select Dosen'])],
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'dosen_id',
                                'data'      =>  ArrayHelper::map(Dosen::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Dosen'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
            [
                'attribute' => 'fakultas_id',
                'value' => 'fakultas.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'fakultas_id',
                                'data'      =>  ArrayHelper::map(Fakultas::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Fakultas'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
//            'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
