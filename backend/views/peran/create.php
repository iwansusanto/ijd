<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peran */

$this->title = 'Create Peran';
$this->params['breadcrumbs'][] = ['label' => 'Perans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
