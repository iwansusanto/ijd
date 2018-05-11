<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PeranHitung */

$this->title = 'Update Peran Hitung: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peran Hitungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peran-hitung-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
