<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FakultasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fakultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakultas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fakultas', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Import Excell', ['import'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'keterangan:ntext',
//            'user_created',
//            'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
