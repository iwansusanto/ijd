<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

        
$this->title = 'Hitung Transaksi: ' . $model->no_transaksi;
$this->params['breadcrumbs'][] = ['label' => 'Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

//$this->registerCssFile("@web/library/jquery-ui-1.12.1.custom/jquery-ui.min.css", [
//    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
//], 'css-jquery-ui');

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/material-teal/easyui.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-theme');

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/icon.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-icon');

//$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/demo/demo.css", [
//    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
//], 'css-easyui-demo');

$session = Yii::$app->session;
?>
<div class="transaksi-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Html::textInput('bulan_tahun', $session['bulan_tahun'], [
                            'class' => 'form-control',
                            'id'    =>  'bulan_tahun']); ?>
    
    <div id="tt" class="easyui-tabs" style="height:auto;">
        <?php foreach ($module as $i=>$modul): ?>
        <div title="<?= $modul->nama; ?>" style="padding:10px" data-moduleid="<?= $modul->id; ?>">
            <?php //if($i == 0): ?>
            <table 
                id="dg<?= $modul->id; ?>" 
                class="easyui-datagrid" 
                title="List Imbal Jasa Modul <?= $modul->nama; ?>">
            </table>
            
            
            <?php //endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div id="tb" style="height:auto">
        <a href="javascript:void(0)" class="btn btn-primary" id="btn-add"><i class="fa fa-plus"></i>&nbsp;Tambah Baris</a>
        <a href="javascript:void(0)" class="btn btn-success" id="btn-save"><i class="fa fa-save"></i>&nbsp;Simpan</a>
        <a href="javascript:void(0)" class="btn btn-warning" id="btn-cancel"><i class="fa fa-mail-reply"></i>&nbsp;Batal</a>
        <a href="javascript:void(0)" class="btn btn-mini btn-danger" id="btn-delete"><i class="fa fa-remove"></i>&nbsp;Hapus Baris</a>
    </div>
</div>



<?php

//$this->registerJsFile(
//    '@web/library/jquery-ui-1.12.1.custom/jquery-ui.min.js',
//    ['depends' => [\yii\web\JqueryAsset::className()]]
//);

$this->registerJsFile(
    '@web/library/jquery-easyui-1.5.5.2/jquery.easyui.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJs(
    "$('#tt').tabs({tabPosition:'bottom'});",
    View::POS_END,
    'my-tab'
);

$this->registerJsFile(
    '@web/script/imbaljasa.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


?>