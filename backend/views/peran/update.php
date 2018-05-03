<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peran */

$this->title = 'Update Peran: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Perans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
