<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\assets;

/**
 * Description of AdminLtePluginAsset
 *
 * @author HP Pavilion
 */
use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle {
    //put your code here
    
//    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
//    public $js = [
//        'datatables/dataTables.bootstrap.min.js',
//        // more plugin Js here
//    ];
//    public $css = [
//        'datatables/dataTables.bootstrap.css',
//        // more plugin CSS here
//    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
