<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

        
$this->title = 'Pivot Fakultas';
$this->params['breadcrumbs'][] = ['label' => 'Report', 'url' => ['pivotfakultas']];
$this->params['breadcrumbs'][] = 'Pivot Fakultas';

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/material-teal/easyui.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-theme');

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/icon.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-icon');


$session = Yii::$app->session;
?>

<div class="row">
    <div id="tb" style="height:auto;" class="col-md-12">
        <div id="p" class="easyui-panel" title="Filter Date" style="padding:10px;margin-bottom: -1px;">
            <div class="container-fluid">
                <div class="row" style="padding: 0px 20px 10px;">
                    <div class="col-md-2">
                        <input class="easyui-datebox" id="start_date" label="Start Date:" labelPosition="left" style="width:100%;">
                    </div>
                    <div class="col-md-2">
                        <input class="easyui-datebox" id="end_date" label="End Date:" labelPosition="left" style="width:100%;">
                    </div>
<!--                    <div class="col-md-4">
                        <input id="dosen" name="dosen" style="width: 100%;">
                    </div>-->
                    <div class="col-md-4">
                        <input id="fakultas" name="fakultas" style="width: 100%;">
                    </div>
                    <div class="col-md-2">
                        
                        <?= $form = Html::beginForm('/export/pdfpivotfakultas', 'POST', [
                                'id'    =>  'form-export-pdfpivotfakultas',
                                'target'    =>  '_blank'
                        ]); ?>

                            <?= Html::hiddenInput('start_date', '', []); ?>
                            <?= Html::hiddenInput('end_date', '', []); ?>
                            <?= Html::hiddenInput('dosen_fakultas_id', '', []); ?>

                            <a href="#" class="easyui-linkbutton" id="filter-report" data-options="iconCls:'icon-search'" style="width:80px">Filter</a>
                            <?= Html::submitButton('Export', [
                                    'class' =>  'easyui-linkbutton',
                                    'id'    =>  'filter-export',
                                    'data-options'  =>  "iconCls:'icon-lock'",
                                    'style' =>  'width:80px'
                            ]); ?>

                        <?= Html::endForm(); ?>
                            
                    </div>
                </div>
            </div>
            
        </div>    
    </div>
    <div class="col-md-12">
        <table id="dg_report" class="easyui-datagrid" title="Report - Pivot Fakultas"></table>
    </div>
</div>




<?php
$this->registerJsFile(
    '@web/library/jquery-easyui-1.5.5.2/jquery.easyui.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/library/jquery-easyui-pivotgrid/jquery.pivotgrid.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/script/report_pivotfakultas.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);?>

