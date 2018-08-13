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
use app\models\Dosen;

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
        $results = [];
        $datas = [];
        
        if($request->post()){
            
            $pdf = Yii::$app->pdf;
        
            $start_date = $request->post('start_date');
//            $start_date = '09/01/2018';
            $end_date = $request->post('end_date');
//            $end_date = '09/30/2018';
            $nip = $request->post('nip');
//            $nip = '195302221982022001';
            
            if(!empty($start_date) && !empty($end_date)){
                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                
                $query = (new \yii\db\Query())
                            ->select(['ij.id', 'ij.tgl_kegiatan', 'ij.dosen_fakultas_id', 'ij.transaksi_id', 'ij.nip', 'ij.nama_dosen',
                                        'ij.nama_fakultas', 'ij.dosen_fakultas_id_digantikan', 'ij.nip_digantikan', 'ij.nama_dosen_digantikan',
                                        'ij.nama_fakultas_digantikan', 'ij.module_tahun_ajaran_id', 'ij.kelas_id', 'ij.nama_kelas',
                                        'ij.ruangan_id', 'ij.nama_ruangan', 'ij.jam_mulai', 'ij.jam_selesai', 'ij.peran_hitung_id', 'ij.peran_id',
                                        'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan', 'mta.nama as nama_module',
                                        'df.fakultas_id'])
                            ->from('imbal_jasa ij')
                            ->leftJoin('module_tahun_ajaran mta', 'ij.module_tahun_ajaran_id = mta.id')
                            ->leftJoin('dosen_fakultas df', 'ij.dosen_fakultas_id = df.id')
                            ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date]);
                
                if(!empty($nip)){
                    $query = $query->andWhere('ij.nip =:nip', [':nip' =>  $nip]);
                    $dosen = Dosen::find()
                                ->where('nip=:nip',[
                                    ':nip'  =>  $nip
                                ])
                                ->one();
                };
            
                $results = $query->orderBy('ij.tgl_kegiatan ASC')
                        ->createCommand()
                        ->queryAll();
                
                foreach ($results as $i=>$res):
                    $datas[$res['nip']]['nama_dosen'] = $res['nama_dosen'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['nama_module'] = $res['nama_module'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['nama_peran'] = $res['nama_peran'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['tgl_kegiatan'] = $res['tgl_kegiatan'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['datas'][$res['kelas_id']]['nama_kelas'] = $res['nama_kelas'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['datas'][$res['kelas_id']]['datas'][$res['fakultas_id']]['nama_fakultas'] = $res['nama_fakultas'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['datas'][$res['kelas_id']]['datas'][$res['fakultas_id']]['datas'][$res['ruangan_id']]['nama_ruangan'] = $res['nama_ruangan'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['datas'][$res['kelas_id']]['datas'][$res['fakultas_id']]['datas'][$res['ruangan_id']]['datas'][] = $res;
                endforeach;
            }
//            print_r($start_date.'-'.$end_date.'-'.$nip);die;
//            echo '<pre>';print_r($datas);die;
            $contentHtml = $this->renderPartial('pdfpivotdosen',[
                                            'datas'  =>  $datas
                ]);

            $pdf->content = $contentHtml;

            $pdf->methods = [
                'SetHeader'=>['<div class="header-ijd"><div class="blue_1">PIVOT DOSEN</div><div class="green-1">'.(!empty($nip) ? $dosen->nama : 'Semua Dosen').'</div></div>'], 
                'SetFooter'=>['|PAGE - {PAGENO}|'],
            ];

            $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfpivotdosen.css';
            $pdf->options = [
                'title' => 'Pivot Dosen'
            ];

            $pdf->marginLeft = 10;
            $pdf->marginRight = 10;
            $pdf->marginTop = 20;
            $pdf->marginBottom = 15;
            $pdf->filename = 'Pivot Dosen '.(!empty($nip) ? $dosen->nama : 'Semua Dosen') . '_'.rand(1, 100).'.pdf';


            return $pdf->render();

        }
        
    }
    
    public function actionPdfpivotfakultas(){
        
        $request = Yii::$app->request;
        $results = [];
        $datas = [];
        
        if($request->post()){
            
            $pdf = Yii::$app->pdf;
        
            $start_date = $request->post('start_date');
//            $start_date = '09/01/2018';
            $end_date = $request->post('end_date');
//            $end_date = '09/30/2018';
            $nip = $request->post('nip');
//            $nip = '195302221982022001';
            
            if(!empty($start_date) && !empty($end_date)){
                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                
                $query = (new \yii\db\Query())
                            ->select(['ij.id', 'ij.tgl_kegiatan', 'ij.dosen_fakultas_id', 'ij.transaksi_id', 'ij.nip', 'ij.nama_dosen',
                                        'ij.nama_fakultas', 'ij.dosen_fakultas_id_digantikan', 'ij.nip_digantikan', 'ij.nama_dosen_digantikan',
                                        'ij.nama_fakultas_digantikan', 'ij.module_tahun_ajaran_id', 'ij.kelas_id', 'ij.nama_kelas',
                                        'ij.ruangan_id', 'ij.nama_ruangan', 'ij.jam_mulai', 'ij.jam_selesai', 'ij.peran_hitung_id', 'ij.peran_id',
                                        'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan', 'mta.nama as nama_module',
                                        'df.fakultas_id'])
                            ->from('imbal_jasa ij')
                            ->leftJoin('module_tahun_ajaran mta', 'ij.module_tahun_ajaran_id = mta.id')
                            ->leftJoin('dosen_fakultas df', 'ij.dosen_fakultas_id = df.id')
                            ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date]);
                
                if(!empty($nip)){
                    $query = $query->andWhere('ij.nip =:nip', [':nip' =>  $nip]);
                    $dosen = Dosen::find()
                                ->where('nip=:nip',[
                                    ':nip'  =>  $nip
                                ])
                                ->one();
                };
            
                $results = $query->orderBy('ij.tgl_kegiatan ASC')
                        ->createCommand()
                        ->queryAll();
                
                foreach ($results as $i=>$res):
                    $datas[$res['fakultas_id']]['nama_fakultas'] = $res['nama_fakultas'];
                    $datas[$res['fakultas_id']]['datas'][$res['nip']]['nama_dosen'] = $res['nama_dosen'];
                    $datas[$res['fakultas_id']]['datas'][$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['nama_module'] = $res['nama_module'];
                    $datas[$res['fakultas_id']]['datas'][$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['nama_peran'] = $res['nama_peran'];
                    $datas[$res['fakultas_id']]['datas'][$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['tgl_kegiatan'] = $res['tgl_kegiatan'];
                    $datas[$res['fakultas_id']]['datas'][$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][$res['peran_id']]['datas'][strtotime($res['tgl_kegiatan'])]['datas'][] = $res;
                endforeach;
            }
//            print_r($start_date.'-'.$end_date.'-'.$nip);die;
//            echo '<pre>';print_r($datas);die;
            $contentHtml = $this->renderPartial('pdfpivotfakultas',[
                                            'datas'  =>  $datas
                ]);

            $pdf->content = $contentHtml;

            $pdf->methods = [
                'SetHeader'=>['<div class="header-ijd"><div class="blue_1">PIVOT FAKULTAS</div><div class="green-1">'.(!empty($nip) ? $dosen->nama : 'Semua Dosen').'</div></div>'], 
                'SetFooter'=>['|PAGE - {PAGENO}|'],
            ];

            $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfpivotfakultas.css';
            $pdf->options = [
                'title' => 'Pivot Fakultas'
            ];

            $pdf->marginLeft = 10;
            $pdf->marginRight = 10;
            $pdf->marginTop = 20;
            $pdf->marginBottom = 15;
            $pdf->filename = 'Pivot Fakultas '.(!empty($nip) ? $dosen->nama : 'Semua Dosen') . '_'.rand(1, 100).'.pdf';


            return $pdf->render();

        }
        
    }
    
    public function actionPdfpivotmodule(){
        
        $request = Yii::$app->request;
        $results = [];
        $datas = [];
        $modules = [];
        $grandTotal = [];
        if($request->post()){
            
            $pdf = Yii::$app->pdf;
        
            $start_date = $request->post('start_date');
//            $start_date = '09/01/2018';
            $end_date = $request->post('end_date');
//            $end_date = '09/30/2018';
            $nip = $request->post('nip');
//            $nip = '195302221982022001';
            
            if(!empty($start_date) && !empty($end_date)){
                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                
                $query = (new \yii\db\Query())
                            ->select(['ij.id', 'ij.tgl_kegiatan', 'ij.dosen_fakultas_id', 'ij.transaksi_id', 'ij.nip', 'ij.nama_dosen',
                                        'ij.nama_fakultas', 'ij.dosen_fakultas_id_digantikan', 'ij.nip_digantikan', 'ij.nama_dosen_digantikan',
                                        'ij.nama_fakultas_digantikan', 'ij.module_tahun_ajaran_id', 'ij.kelas_id', 'ij.nama_kelas',
                                        'ij.ruangan_id', 'ij.nama_ruangan', 'ij.jam_mulai', 'ij.jam_selesai', 'ij.peran_hitung_id', 'ij.peran_id',
                                        'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan', 'mta.nama as nama_module',
                                        'df.fakultas_id'])
                            ->from('imbal_jasa ij')
                            ->leftJoin('module_tahun_ajaran mta', 'ij.module_tahun_ajaran_id = mta.id')
                            ->leftJoin('dosen_fakultas df', 'ij.dosen_fakultas_id = df.id')
                            ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date]);
                
                if(!empty($nip)){
                    $query = $query->andWhere('ij.nip =:nip', [':nip' =>  $nip]);
                    $dosen = Dosen::find()
                                ->where('nip=:nip',[
                                    ':nip'  =>  $nip
                                ])
                                ->one();
                };
            
                $results = $query->orderBy('ij.tgl_kegiatan ASC')
                        ->createCommand()
                        ->queryAll();
                
                foreach ($results as $i=>$res):
                    $modules[$res['module_tahun_ajaran_id']] = $res['nama_module'];
                    
                    $datas[$res['nip']]['nama_dosen'] = $res['nama_dosen'];
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['nama_module'] = $res['nama_module'];
                    $datas[$res['nip']]['total'] += ($res['honor']+$res['transport']);
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['sum_honor'] += (empty($res['honor']) ? 0 : $res['honor']);
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['sum_transport'] += (empty($res['transport']) ? 0 : $res['transport']);
                    $datas[$res['nip']]['datas'][$res['module_tahun_ajaran_id']]['datas'][] = $res;
                    
                    $grandTotal[$res['module_tahun_ajaran_id']]['grand_total_honor'] += (empty($res['honor']) ? 0 : $res['honor']);
                    $grandTotal[$res['module_tahun_ajaran_id']]['grand_total_transport'] += (empty($res['transport']) ? 0 : $res['transport']);
                endforeach;
            }
//            print_r($start_date.'-'.$end_date.'-'.$nip);die;
//            echo '<pre>';print_r($datas);die;
            $contentHtml = $this->renderPartial('pdfpivotmodule',[
                                            'datas'  =>  $datas,
                                            'modules'  =>  $modules,
                                            'grandTotal'   =>  $grandTotal
                ]);

            $pdf->content = $contentHtml;

            $pdf->methods = [
                'SetHeader'=>['<div class="header-ijd"><div class="blue_1">PIVOT MODUL</div><div class="green-1">'.(!empty($nip) ? $dosen->nama : 'Semua Dosen').'</div></div>'], 
                'SetFooter'=>['|PAGE - {PAGENO}|'],
            ];

            $pdf->cssFile = Yii::getAlias('@webroot').'/css/pdfpivotmodule.css';
            $pdf->options = [
                'title' => 'Pivot Fakultas'
            ];

            $pdf->marginLeft = 10;
            $pdf->marginRight = 10;
            $pdf->marginTop = 20;
            $pdf->marginBottom = 15;
            $pdf->filename = 'Pivot Fakultas '.(!empty($nip) ? $dosen->nama : 'Semua Dosen') . '_'.rand(1, 100).'.pdf';


            return $pdf->render();

        }
        
    }
}
