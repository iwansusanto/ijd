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
use app\models\ModuleTahunAjaran;

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
        
//        $moduletahunajaranid = $request->post('moduletahunajaranid');
        $moduletahunajaranid = 1;
//        $transaksi_id = $request->post('transaksi_id');
        $transaksi_id = 26;
        
        $imbajJasa = ImbalJasa::find()
                        ->where('module_tahun_ajaran_id=:module_tahun_ajaran_id AND transaksi_id=:transaksi_id', 
                                                [':module_tahun_ajaran_id'   =>  $moduletahunajaranid,
                                                 ':transaksi_id'    =>  $transaksi_id])
                        ->all();
        
        $moduleTahunAjaran = ModuleTahunAjaran::findOne($moduletahunajaranid);
        
        $contentHtml = $this->renderPartial('pdfijd',[
                            'imbalJasa' =>  $imbajJasa,
                            'moduleTahunAjaran'    =>  $moduleTahunAjaran
        ]);
        
        $pdf = Yii::$app->pdf;
        $pdf->content = $contentHtml;
        
        $pdf->methods = [
            'SetHeader'=>['Report Header'], 
            'SetFooter'=>['|Hal - {PAGENO}|'],
        ];
        
        $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfijd.css';
        $pdf->options = [
            'title' => 'Remun '.$moduleTahunAjaran->nama
        ];
        
        
        return $pdf->render();
    }
}
