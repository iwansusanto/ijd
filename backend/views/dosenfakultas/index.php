<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Dosen;
use app\models\TahunAjaran;
use app\models\Fakultas;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\View;

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
        <?php 
            if ($dataProvider->getTotalCount() === 0) { 
                echo Html::button('Template Dosenfakultas', [
                        'type'  =>  'button',
                        'class' => 'btn btn-danger',
                        'data-toggle'   =>  'modal',
                        'data-target'    =>  '.bs-example-modal-lg',
//                        'title' =>  'Template Berdasarkan Tahun Ajaran Terakhir'
                    ]);
            }; ?>
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

<div class="modal fade bs-example-modal-lg" role="dialog" tabindex="-1" aria-labelledby="myLargeModalLabel" > 
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                <h4 class="modal-title" id="myLargeModalLabel">Choose Template</h4> 
            </div> 
            <div class="modal-body">
                <?= Html::label('Pilih Tahun Ajaran Sebagai Template', 'tahun_ajaran_id', []) ?>
                <?= Select2::widget([
                            'name' => 'tahun_ajaran_id',
                            'data'      =>  ArrayHelper::map(TahunAjaran::find()->where('id<>:tahun_ajaran_id', [
                                                    ':tahun_ajaran_id'  =>  Yii::$app->is->tahunAjaran()->id
                                            ])->asArray()->all(), 'id', 'periode'),
                            'options'   =>  [
                                'placeholder'  =>  'Select Tahun Ajaran'],
                            'pluginOptions' =>  [
                                'allowClear'    =>  true
                            ],
                            'pluginEvents'  => [
                                "select2:select"    =>  "function(data){
                                    console.log($(this).val());
                                    var datas = [];
                                    datas = {
                                        'id': $(this).val()};
                                    $.ajax({
                                        type    : \"POST\",
                                        url     : _baseUrl+\"/dosenfakultas/sessiontemplate\",
                                        data    : {TahunAjaran: datas},
                                        success : function(data){
                                            console.log(data);
                                            window.location.replace(data.url_redirect);
                                        },
                                        error   : function(data){
                                            console.log(data);
                                        }
                                    });
                                }"
                            ]]) ?>
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div> 
    </div> 
</div>