<?php

use yii\helpers\Html;
use app\models\TahunAjaran;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Dosenfakultas */

$this->title = 'Template Tahun Ajaran '.$tahunAjaran->periode;
$this->params['breadcrumbs'][] = ['label' => 'Dosenfakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="dosenfakultas-create">

    <h1>Template Dosen Fakultas</h1>
    
    
    <?=
    $this->render('_formtemplate', [
        'model' => $model,
        'dosen' =>  $dosen,
        'fakultas' =>  $fakultas,
        'tahunAjaran'  =>  $tahunAjaran
    ]) ?>

</div>