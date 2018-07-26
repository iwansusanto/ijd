<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Noteijd */

$this->title = 'Update Noteijd: No Urut #' . $model->no_urut;
$this->params['breadcrumbs'][] = ['label' => 'Noteijd', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'No Urut #'.$model->no_urut, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noteijd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'no_urut'  =>  $no_urut,
        'disable_value'    =>  $disable_value
    ]) ?>

</div>
