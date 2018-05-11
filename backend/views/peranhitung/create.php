<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PeranHitung */

$this->title = 'Create Peran Hitung';
$this->params['breadcrumbs'][] = ['label' => 'Peran Hitungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peran-hitung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
