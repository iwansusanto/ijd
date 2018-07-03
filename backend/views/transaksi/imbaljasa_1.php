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

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/material-teal/easyui.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-theme');

$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/themes/icon.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
], 'css-easyui-icon');

//$this->registerCssFile("@web/library/jquery-easyui-1.5.5.2/demo/demo.css", [
//    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
//], 'css-easyui-demo');

?>
<div class="transaksi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="tt" class="easyui-tabs" style="width:100%;height:auto;">
        <?php foreach ($module as $i=>$modul): ?>
        <div title="<?= $modul->nama ?>" style="padding:10px">
            <?php if($i == 0): ?>
            <table 
                id="dg" 
                class="easyui-datagrid" 
                title="List Imbal Jasa Modul <?= $modul->nama; ?>" 
                style="width: 100%; height: auto;" 
                data-options="
                    iconCls: 'fa fa-th',
                    toolbar: '#tb-<?= $modul->id; ?>',
                    ">
                
                <thead frozen="true">
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th data-options="field:'nama_fakultas',width:100,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:true
                                                }
                                            }">Induk Fakultas</th>
                        <th data-options="field:'nama_dosen_digantikan',width:200,
                                            editor:{
                                                type:'combobox',
                                                options:{
                                                    valueField:'id',
                                                    textField:'nama',
                                                    method:'get',
                                                    url:'<?= Url::to(['jsondosen']) ?>',
                                                    required:true
                                                }}">Nama Dosen Yang Digantikan</th>
                        <th data-options="field:'nama_fakultas_digantikan',width:180,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:true
                                                }
                                            }">Fakultas Yang Digantikan</th>
                        
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th data-options="field:'nama_module',width:200,
                                            editor:{
                                                type:'combobox',
                                                options:{
                                                    valueField:'id',
                                                    textField:'nama',
                                                    method:'get',
                                                    url:'<?= Url::to(['jsonmodule']) ?>',
                                                    required:true
                                                }}">Modul</th>
                        <th data-options="field:'nama_kelas',width:80,
                                            editor:{
                                                type:'combobox',
                                                options:{
                                                    valueField:'id',
                                                    textField:'nama',
                                                    method:'get',
                                                    url:'<?= Url::to(['jsonkelas']) ?>',
                                                    required:true
                                                }}">Nama Kelas</th>
                        <th data-options="field:'nama_ruangan',width:80,
                                            editor:{
                                                type:'combobox',
                                                options:{
                                                    valueField:'id',
                                                    textField:'nama',
                                                    method:'get',
                                                    url:'<?= Url::to(['jsonruang']) ?>',
                                                    required:true
                                                }}">Ruang</th>
                        <th data-options="field:'tgl_kegiatan',width:120,
                                            editor:{
                                                type:'datebox',
                                                options:{
                                                    required:true
                                                }}">Tgl Kegiatan</th>
                        <th data-options="field:'jam_mulai',width:80">Jam Mulai</th>
                        <th data-options="field:'jam_selesai',width:80">Jam Selesai</th>
                        <th data-options="field:'nama_peran',width:150,
                                            editor:{
                                                type:'combobox',
                                                options:{
                                                    valueField:'id',
                                                    textField:'nama',
                                                    method:'get',
                                                    url:'<?= Url::to(['jsonperan']) ?>',
                                                    required:true
                                                }}">Peran</th>
                        <th data-options="field:'jumlah_jam_rumus',width:150,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:true
                                                }
                                            }">Jumlah Jam Rumus</th>
                        <th data-options="field:'transport',width:80,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:true
                                                }
                                            }">Transport</th>
                        <th data-options="field:'honor',width:150,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:true
                                                }
                                            }">Honor Diterima</th>
                        <th data-options="field:'keterangan',width:200,
                                            editor:{
                                                type:'textbox',
                                                options:{
                                                    readonly:false
                                                }
                                            }">Keterangan</th>
                    </tr>
                </thead>
                
            </table>
            <?php endif; ?>
            <div id="tb-<?= $modul->id; ?>" style="height:auto">
                <a href="javascript:void(0)" class="btn btn-primary"  onclick="imbaljasa.append()"><i class="fa fa-plus"></i>&nbsp;Tambah Baris</a>
                <a href="javascript:void(0)" class="btn btn-success" onclick="imbaljasa.accept()"><i class="fa fa-save"></i>&nbsp;Simpan</a>
                <a href="javascript:void(0)" class="btn btn-warning" onclick="imbaljasa.reject()"><i class="fa fa-mail-reply"></i>&nbsp;Batal</a>
                <a href="javascript:void(0)" class="btn btn-mini btn-danger" onclick="imbaljasa.removeit()"><i class="fa fa-remove"></i>&nbsp;Hapus Baris</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>



<?php

$this->registerJsFile(
    '@web/library/jquery-easyui-1.5.5.2/jquery.easyui.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJs(
    "$('#tt').tabs({tabPosition:'bottom'}); 
    var _urlGrid = \'".Url::to(['jsonimbaljasa', 'module_id'  =>  $modul->id])."\'
        _baseUrl = \'".Url::base()."\'",
    View::POS_END,
    'my-tab'
);

$this->registerJsFile(
    '@web/script/imbaljasa.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


?>
