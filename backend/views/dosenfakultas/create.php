<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dosenfakultas */

$this->title = 'Create Dosenfakultas';
$this->params['breadcrumbs'][] = ['label' => 'Dosenfakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosenfakultas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
