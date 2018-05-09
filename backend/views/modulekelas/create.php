<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModuleKelas */

$this->title = 'Create Module Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Module Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-kelas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
