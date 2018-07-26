<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noteijd */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noteijd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noteijd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'tahun_ajaran_id',
            'title',
            'no_urut',
//            'user_created',
//            'user_updated',
//            'update_time',
        ],
    ]) ?>

</div>
