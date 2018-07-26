<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TahunAjaran;
use app\models\Jabatan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonijdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personijd';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personijd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personijd', ['create'], ['class' => 'btn btn-success']) ?>
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
            'nip',
            'nama',
            [
                'attribute' => 'jabatan_id',
                'value' => 'jabatan.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'jabatan_id',
                                'data'      =>  ArrayHelper::map(Jabatan::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Jabatan'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
            //'nama',
            //'status',
            //'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
