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
//use app\models\Module;
use app\models\ModuleTahunAjaran;
use app\models\Transaksi;
use app\models\PeranHitung;
use app\models\Noteijd;

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
//        $tahunajaran_id = $request->post('tahunajaran_id');
        $tahunajaran_id = 14;
        
        $transaksi = Transaksi::findOne($transaksi_id);
        
        $imbajJasa = ImbalJasa::find()
                        ->where('module_tahun_ajaran_id=:module_tahun_ajaran_id AND transaksi_id=:transaksi_id', 
                                                [':module_tahun_ajaran_id'   =>  $moduletahunajaranid,
                                                 ':transaksi_id'    =>  $transaksi_id])
                        ->all();
        
        $moduleTahunAjaran = ModuleTahunAjaran::findOne($moduletahunajaranid);
        
        $peranHitung = PeranHitung::find()
                        ->where('module_tahun_ajaran_id=:module_tahun_ajaran_id AND '
                                . 'tahun_ajaran_id=:tahun_ajaran_id AND '
                                . 'bulan=:bulan AND tahun=:tahun',[
                                    ':module_tahun_ajaran_id'   =>  $moduletahunajaranid,
                                    ':tahun_ajaran_id'   =>  $tahunajaran_id,
                                    ':bulan'   =>  Yii::$app->is->bulanhitung($transaksi->bulan_tahun),
                                    ':tahun'   =>  Yii::$app->is->tahunhitung($transaksi->bulan_tahun),
                        ])
                        ->all();
        
        $noteIjd = Noteijd::find()
                    ->where('tahun_ajaran_id=:tahun_ajaran_id', [
                                ':tahun_ajaran_id'  =>  $tahunajaran_id
                    ])
                    ->all();
        
        $contentHtml = $this->renderPartial('pdfijd',[
                            'imbajJasa' =>  $imbajJasa,
                            'transaksi'    =>  $transaksi,
                            'moduleTahunAjaran'    =>  $moduleTahunAjaran,
                            'peranHitung'  =>  $peranHitung,
                            'noteIjd'   =>  $noteIjd
        ]);
        
        $pdf = Yii::$app->pdf;
        $pdf->content = $contentHtml;
        
        $pdf->methods = [
            'SetHeader'=>['<div class="header-ijd"><div class="blue_1">REKAPITULASI JAM DAN HONOR PENGAJARAN DOSEN</div><div class="green-1">MODUL RUMPUN ILMU KESEHATAN</div></div>'], 
            'SetFooter'=>['|PAGE - {PAGENO}|'],
        ];
        
        $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfijd.css';
        $pdf->options = [
            'title' => 'Remun '.$moduleTahunAjaran->nama
        ];
        
        $pdf->marginLeft = 10;
        $pdf->marginRight = 10;
        $pdf->marginTop = 20;
        $pdf->marginBottom = 15;
        $pdf->filename = 'Remun '.$moduleTahunAjaran->module->nama. '_'.Yii::$app->is->bulanhitung($transaksi->bulan_tahun).'-'.Yii::$app->is->tahunhitung($transaksi->bulan_tahun). '_'.rand(1, 100).'.pdf';
        
        
        return $pdf->render();
    }
}
