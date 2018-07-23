<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuleTahunAjaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Tahun Ajarans';
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
            'id',
            'periode',
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
