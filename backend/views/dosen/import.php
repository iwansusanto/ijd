<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Import Excell';
$this->params['breadcrumbs'][] = ['label' => 'Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php

Yii::$app->session->getAllFlashesNormalized();
$form = ActiveForm::begin(['options'    =>  ['enctype'  =>  'multipart/form-data']]);

echo $form->field($modelImport, 'fileImport')->fileInput();

echo Html::submitButton('Import', ['class' =>    'btn btn-primary']);

ActiveForm::end();

?>