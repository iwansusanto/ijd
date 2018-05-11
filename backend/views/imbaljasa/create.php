<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImbalJasa */

$this->title = 'Create Imbal Jasa';
$this->params['breadcrumbs'][] = ['label' => 'Imbal Jasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imbal-jasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
