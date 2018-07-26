<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Personijd */

$this->title = 'Create Personijd';
$this->params['breadcrumbs'][] = ['label' => 'Personijd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personijd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
