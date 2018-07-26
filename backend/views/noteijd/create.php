<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Noteijd */

$this->title = 'Create Noteijd';
$this->params['breadcrumbs'][] = ['label' => 'Noteijd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noteijd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'no_urut'  =>  $no_urut,
        'disable_value'    =>  $disable_value
    ]) ?>

</div>
