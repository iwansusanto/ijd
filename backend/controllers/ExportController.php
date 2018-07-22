<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\ImbalJasa;
use app\models\Module;

/**
 * Description of ExportController
 *
 * @author HP Pavilion
 */
class ExportController extends Controller {
    //put your code here
    
    public function afterAction($action, $result) {
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        
        parent::afterAction($action, $result);
    }
    
    public function actionPdfijd(){
        
        $request = Yii::$app->request;
        
        $moduleid = $request->post('moduleid');
        $transaksi_id = $request->post('transaksi_id');
        
        $imbajJasa = ImbalJasa::find()
                        ->where('module_id=:module_id AND transaksi_id=:transaksi_id', 
                                                [':module_id'   =>  $moduleid,
                                                 ':transaksi_id'    =>  $transaksi_id])
                        ->all();
        
        $module = Module::findOne($moduleid);
        
        $contentHtml = $this->renderPartial('pdfijd',[
                            'imbalJasa' =>  $imbajJasa,
                            'module'    =>  $module
        ]);
        
        $pdf = Yii::$app->pdf;
        $pdf->content = $contentHtml;
        
        $pdf->methods = [
            'SetHeader'=>['Report Header'], 
            'SetFooter'=>['|Hal - {PAGENO}|'],
        ];
        
        $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfijd.css';
        $pdf->options = [
            'title' => 'Remun '.$module->nama
        ];
        
        
        return $pdf->render();
    }
}
