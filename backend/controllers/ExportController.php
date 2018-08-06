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
use app\models\Personijd;
use kartik\mpdf\Pdf;

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
        
        if($request->post()){
            $moduletahunajaranid = $request->post('moduletahunajaranid');
    //        $moduletahunajaranid = 1;
            $transaksi_id = $request->post('transaksi_id');
    //        $transaksi_id = 26;
            $tahunajaran_id = $request->post('tahunajaran_id');
    //        $tahunajaran_id = 14;

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

            $personIjd = Personijd::find()
                            ->where('tahun_ajaran_id=:tahun_ajaran_id AND jabatan_id=:jabatan_id',[
                                        ':tahun_ajaran_id'  =>  $tahunajaran_id,
                                        ':jabatan_id'   => Personijd::JABATAN_SDM
                            ])
                            ->one();

            $pdf = Yii::$app->pdf;

    //        $mpdf = $pdf->api;
    //        $stylesheet = file_get_contents(Yii::getAlias('@webroot').'/css/pdfijd.css');
    //        $mpdf->WriteHTML($stylesheet,1);
    //        
    //        $mpdf->SetTitle('Remun '.$moduleTahunAjaran->nama);
    //        $mpdf->SetHeader('<div class="header-ijd"><div class="blue_1">REKAPITULASI JAM DAN HONOR PENGAJARAN DOSEN</div><div class="green-1">MODUL RUMPUN ILMU KESEHATAN</div></div>'); // call methods or set any properties
    //        
    //        
    //        $contentHtml = $this->renderPartial('pdfijd',[
    //                            'imbajJasa' =>  $imbajJasa,
    //                            'transaksi'    =>  $transaksi,
    //                            'moduleTahunAjaran'    =>  $moduleTahunAjaran,
    //                            'peranHitung'  =>  $peranHitung,
    //                            'noteIjd'   =>  $noteIjd,
    //                            'personIjd'    =>  $personIjd,
    //                            'mpdf' =>  $mpdf
    //        ]);
    //        
    //        
    //        
    //        $mpdf->WriteHTML($contentHtml, 2);
    //        
    //        
    //        $mpdf->SetFooter('|PAGE - {PAGENO}|');
    //                
    //        echo $mpdf->Output('Remun '.$moduleTahunAjaran->module->nama. '_'.Yii::$app->is->bulanhitung($transaksi->bulan_tahun).'-'.Yii::$app->is->tahunhitung($transaksi->bulan_tahun). '_'.rand(1, 100).'.pdf', 'I'); // call the mpdf api output as needed
            //
            $contentHtml = $this->renderPartial('pdfijd',[
                                'imbajJasa' =>  $imbajJasa,
                                'transaksi'    =>  $transaksi,
                                'moduleTahunAjaran'    =>  $moduleTahunAjaran,
                                'peranHitung'  =>  $peranHitung,
                                'noteIjd'   =>  $noteIjd,
                                'personIjd'    =>  $personIjd
            ]);

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
    
    public function actionPdfpivotdosen(){
        $request = Yii::$app->request;
        
        if($request->post()){
            
            $pdf = Yii::$app->pdf;
        
//            $start_date = $request->post('start_date');
            $start_date = '09/01/2018';
//            $end_date = $request->post('end_date');
            $end_date = '09/30/2018';
//            $nip = $request->post('nip');
            $nip = '010603184';
            
//            print_r($start_date.'-'.$end_date.'-'.$nip);die;

            $contentHtml = $this->renderPartial('pdfpivotdosen',[

                ]);

            $pdf->content = $contentHtml;

            $pdf->methods = [
                'SetHeader'=>['<div class="header-ijd"><div class="blue_1">PIVOT DOSEN</div><div class="green-1">IWAN SUSANTO</div></div>'], 
                'SetFooter'=>['|PAGE - {PAGENO}|'],
            ];

            $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfijd.css';
            $pdf->options = [
                'title' => 'Pivot Dosen'
            ];

            $pdf->marginLeft = 10;
            $pdf->marginRight = 10;
            $pdf->marginTop = 20;
            $pdf->marginBottom = 15;
            $pdf->filename = 'Pivot Dosen Iwan Susanto' . '_'.rand(1, 100).'.pdf';


            return $pdf->render();

        }
        
    }
}
