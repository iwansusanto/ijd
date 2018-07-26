<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\TahunAjaran;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoteijdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noteijd';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noteijd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Noteijd', ['create'], ['class' => 'btn btn-success']) ?>
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
            'title',
            'no_urut',
//            'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
