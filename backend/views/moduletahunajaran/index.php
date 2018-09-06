<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TahunAjaran;
use app\models\Semester;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuleTahunAjaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Tahun Ajaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-tahun-ajaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Module Tahun Ajaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'periode',
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
                'attribute' => 'semester_id',
                'value' => 'semester.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'semester_id',
                                'data'      =>  ArrayHelper::map(Semester::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Semester'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
//            'tahun_ajaran_id',
//            'module_id',
            'nama',
            //'jumlah_sks',
            //'jumlah_menit_per_sks',
            //'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
