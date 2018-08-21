<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-index">

    <h1><?= Html::encode($this->title).Html::tag('i', '', [
                'class' =>  'fa fa-question-circle-o',
                'aria-hidden'   => 'true',
                'data-title'=>'Info',
                'data-content'=>'Jabatan ini akan digunakan saat proses generate report sebagai pihak yang akan mengetahui',
                'data-toggle'=>'popover',
                'style'=>'margin-left: 10px; font-size: 20px; cursor:pointer;'
            ]) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jabatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'nama',
//            'user_created',
//            'user_updated',
//            'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
