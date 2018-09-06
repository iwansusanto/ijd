<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TahunAjaran;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Kelas;
use app\models\Module;
use yii\widgets\Pjax;
use app\models\Semester;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuleKelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-kelas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Module Kelas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= Html::beginForm(['deleteall'],'post');?>
    <?php $delete_button = Html::submitButton('Delete All', ['class' => 'btn btn-danger deleteall']); ?>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'    =>  'grid-module_kelas',
        'layout' => "{summary}\n$delete_button{items}\n{pager}\n{summary}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn',],
            

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
                'attribute' => 'semester_id',
                'value' => 'semester.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'semester_id',
                                'data'      =>  ArrayHelper::map(Semester::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Semester'],
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
                'attribute' => 'kelas_id',
                'value' => 'kelas.nama',
                'filter' => Select2::widget([
                                'model' =>  $searchModel,
                                'attribute'      =>  'kelas_id',
                                'data'      =>  ArrayHelper::map(Kelas::find()->asArray()->all(), 'id', 'nama'),
                                'options'   =>  ['placeholder'  =>  'Select Kelas'],
                                'pluginOptions' =>  ['allowClear'    =>  true]])],
//            'user_created',
            //'user_updated',
            //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        
    ]); ?>
    
    
    <?= Html::endForm();?> 
    <?php Pjax::end(); ?>
    <?php
    
        $this->registerJs('
            $(\'.deleteall\').prop(\'disabled\', true);
            $(document).on("click", ".deleteall",function(event){
             
                event.preventDefault();
                var ids =  $(\'#grid-module_kelas\').yiiGridView(\'getSelectedRows\');
                
                if(ids.length > 0){
                    if(confirm("Are You Sure To Delete Selected Record !")){
                          $.ajax({
                            type: \'POST\',
                            url :  \'deleteall\',
                            data : {ids: ids},
                            dataType : \'JSON\',
                            success : function(res) {
                                if(res.success){
                                    $.pjax.reload({container:\'#grid-module_kelas\', url: \'/modulekelas/index\'});
                                }
                            }
                        });
                    }
                }else{
                    alert(\'Please Select Record \');
                }
            });
            
            $(\'form\').find(\'input[type="checkbox"]\').each(function(){
                var el = $(this);
                
                el.on(\'change\', function(){
                    if(el.prop(\'checked\') == true) {
                        $(\'.deleteall\').prop(\'disabled\', false);
                    } else {
                        var count_check = $(\'input[name="selection[]"]:checked\').length; 
                        if(count_check == 0){
                            $(\'.deleteall\').prop(\'disabled\', true);
                        };
                    };
                });
            });
            ', \yii\web\View::POS_READY);
        ?>
</div>
