<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModuleTahunAjaran */

$this->title = 'Create Module Tahun Ajaran';
$this->params['breadcrumbs'][] = ['label' => 'Module Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-tahun-ajaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
