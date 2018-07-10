<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImbalJasa;
use yii\web\Response;

/**
 * TRansaksiController implements the CRUD actions for Transaksi model.
 */
class ReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    /**
     * Finds the Transaksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionGabung()
    {
        
        return $this->render('gabung', [
            
        ]);
    }
    
    public function actionJsonreportgabung(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $result = [];
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $start_date = Yii::$app->request->get('start_date');
                $end_date = Yii::$app->request->get('end_date');
                
                if(!empty($start_date) && !empty($end_date)){
                    
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = date('Y-m-d', strtotime($end_date));
                    
                    $query = (new \yii\db\Query())
                                ->select(['ij.id', 'ij.nip', 'ij.nama_dosen', 'ij.nama_fakultas', 
                                            'IfNull(ij.nama_dosen_digantikan, "-") AS nama_dosen_digantikan',
                                            new \yii\db\Expression('CASE '
                                                                    . 'WHEN ij.nama_fakultas_digantikan IS NULL THEN "-" '
                                                                    . 'WHEN ij.nama_fakultas_digantikan = "" THEN "-" '
                                                                    . 'ELSE ij.nama_fakultas_digantikan '
                                                                    . 'END AS nama_fakultas_digantikan'),
                                            'ij.nama_module', 'ij.nama_kelas', 'ij.nama_ruangan', 
                                            'DATE_FORMAT(ij.tgl_kegiatan, "%d %b %Y") AS tgl_kegiatan',
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_mulai,  "%H:%i") as jam_mulai'),
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_selesai,  "%H:%i") as jam_selesai'),
                                            'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan'])
                                ->from('imbal_jasa ij')
                                ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date])
                                ->orderBy('ij.tgl_kegiatan ASC')
                                ->createCommand();

                            $results = $query->queryAll();
                };
                
  
                $honor = 0;
                $transport = 0;
                if(!empty($results)){
                    foreach ($results as $i=>$res):
                        $honor+=$res['honor'];
                        $transport+=$res['transport'];
                    endforeach;
                };
                
                $result = [
                    'total' =>  count($results),
                    'rows'  =>  $results,
                    'footer'    =>  [
                        [
                            'nama_dosen'   =>  'Total',
                            'honor'   =>  $honor,
                            'transport'   =>  $transport,
                        ]
                    ]
                ];
            }
        }
        
        return $result;
    }
    
    public function actionPivotdosen()
    {
        
        return $this->render('pivotdosen', [
            
        ]);
    }
    
    public function actionJsonreportpivotdosen(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $results = [];
        $vivotSum = [];
        
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $start_date = Yii::$app->request->get('start_date');
                $end_date = Yii::$app->request->get('end_date');
                
                if(!empty($start_date) && !empty($end_date)){
                    
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = date('Y-m-d', strtotime($end_date));
                    
                    $query = (new \yii\db\Query())
                                ->select(['ij.id', 'ij.nip', 'ij.nama_dosen', 'ij.nama_fakultas', 
                                            'IfNull(ij.nama_dosen_digantikan, "-") AS nama_dosen_digantikan',
                                            new \yii\db\Expression('CASE '
                                                                    . 'WHEN ij.nama_fakultas_digantikan IS NULL THEN "-" '
                                                                    . 'WHEN ij.nama_fakultas_digantikan = "" THEN "-" '
                                                                    . 'ELSE ij.nama_fakultas_digantikan '
                                                                    . 'END AS nama_fakultas_digantikan'),
                                            'ij.nama_module', 'ij.module_id', 'ij.nama_kelas', 'ij.nama_ruangan', 
                                            'DATE_FORMAT(ij.tgl_kegiatan, "%d %b %Y") AS tgl_kegiatan',
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_mulai,  "%H:%i") as jam_mulai'),
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_selesai,  "%H:%i") as jam_selesai'),
                                            'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan'])
                                ->from('imbal_jasa ij')
                                ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date])
                                ->orderBy('ij.tgl_kegiatan ASC')
                                ->createCommand();

                            $results = $query->queryAll();
                            
                            $honor = 0;
                            $transport = 0;
                            
                            if(!empty($results)){
                                foreach ($results as $i=>$res):
                                    $honor+=$res['honor'];
                                    $transport+=$res['transport'];
                                endforeach;
                            };
                            
                            foreach ($results as $el) {
                                if (!array_key_exists($el['nip'], $vivotSum)) {
                                    $vivotSum[$el['nip']] = array(
                                        'id' => 'nip',
                                        'nip' => $el['nip'],
                                        'nama_dosen' => $el['nama_dosen'],
                                        'nama_fakultas' => $el['nama_fakultas'],
                                        'nama_dosen_digantikan' => $el['nama_dosen_digantikan'],
                                        'nama_fakultas_digantikan' => $el['nama_fakultas_digantikan'],
                                        'nama_module' => $el['nama_module'],
                                        'module_id' => $el['module_id'],
                                        'nama_kelas' => $el['nama_kelas'],
                                        'nama_ruangan' => $el['nama_ruangan'],
                                        'tgl_kegiatan' => 'Total',
                                        'jam_mulai' => $el['jam_mulai'],
                                        'jam_selesai' => $el['jam_selesai'],
                                        'nama_peran' => $el['nama_peran'],
                                        'jumlah_jam_rumus' => $el['jumlah_jam_rumus'],
                                        'honor' =>  $el['honor'],
                                        'transport' =>  $el['transport'],
                                        'keterangan' => $el['keterangan']
                                    );
                                } else {
                                    $vivotSum[$el['nip']]['honor'] = $vivotSum[$el['nip']]['honor'] + $el['honor']; 
                                    $vivotSum[$el['nip']]['transport'] = $vivotSum[$el['nip']]['transport'] + $el['transport']; 
                                    $vivotSum[$el['nip']]['jumlah_jam_rumus'] = $vivotSum[$el['nip']]['jumlah_jam_rumus'] + $el['jumlah_jam_rumus']; 
                                }
                            }
                            
                            $results = array_merge($vivotSum, $results);

                };
                
                $result = $results;
            }
        }
        
        return $result;
    }
    
    public function actionPivotfakultas()
    {
        
        return $this->render('pivotfakultas', [
            
        ]);
    }
    
    public function actionJsonreportpivotfakultas(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $results = [];
        $vivotSum = [];
        
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $start_date = Yii::$app->request->get('start_date');
                $end_date = Yii::$app->request->get('end_date');
                
                if(!empty($start_date) && !empty($end_date)){
                    
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = date('Y-m-d', strtotime($end_date));
                    
                    $query = (new \yii\db\Query())
                                ->select(['ij.id', 'ij.nip', 'ij.nama_dosen', 'ij.nama_fakultas', 
                                            'IfNull(ij.nama_dosen_digantikan, "-") AS nama_dosen_digantikan',
                                            new \yii\db\Expression('CASE '
                                                                    . 'WHEN ij.nama_fakultas_digantikan IS NULL THEN "-" '
                                                                    . 'WHEN ij.nama_fakultas_digantikan = "" THEN "-" '
                                                                    . 'ELSE ij.nama_fakultas_digantikan '
                                                                    . 'END AS nama_fakultas_digantikan'),
                                            'ij.nama_module', 'ij.module_id', 'ij.nama_kelas', 'ij.nama_ruangan', 
                                            'DATE_FORMAT(ij.tgl_kegiatan, "%d %b %Y") AS tgl_kegiatan',
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_mulai,  "%H:%i") as jam_mulai'),
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_selesai,  "%H:%i") as jam_selesai'),
                                            'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan'])
                                ->from('imbal_jasa ij')
                                ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date])
                                ->orderBy('ij.tgl_kegiatan ASC')
                                ->createCommand();

                            $results = $query->queryAll();
                            
                            $honor = 0;
                            $transport = 0;
                            
                            if(!empty($results)){
                                foreach ($results as $i=>$res):
                                    $honor+=$res['honor'];
                                    $transport+=$res['transport'];
                                endforeach;
                            };
                            
                            foreach ($results as $el) {
                                if (!array_key_exists($el['nip'], $vivotSum)) {
                                    $vivotSum[$el['nip']] = array(
                                        'id' => 'nip',
                                        'nip' => $el['nip'],
                                        'nama_dosen' => $el['nama_dosen'],
                                        'nama_fakultas' => $el['nama_fakultas'],
                                        'nama_dosen_digantikan' => $el['nama_dosen_digantikan'],
                                        'nama_fakultas_digantikan' => $el['nama_fakultas_digantikan'],
                                        'nama_module' => $el['nama_module'],
                                        'module_id' => $el['module_id'],
                                        'nama_kelas' => $el['nama_kelas'],
                                        'nama_ruangan' => $el['nama_ruangan'],
                                        'tgl_kegiatan' => 'Total',
                                        'jam_mulai' => $el['jam_mulai'],
                                        'jam_selesai' => $el['jam_selesai'],
                                        'nama_peran' => $el['nama_peran'],
                                        'jumlah_jam_rumus' => $el['jumlah_jam_rumus'],
                                        'honor' =>  $el['honor'],
                                        'transport' =>  $el['transport'],
                                        'keterangan' => $el['keterangan']
                                    );
                                } else {
                                    $vivotSum[$el['nip']]['honor'] = $vivotSum[$el['nip']]['honor'] + $el['honor']; 
                                    $vivotSum[$el['nip']]['transport'] = $vivotSum[$el['nip']]['transport'] + $el['transport']; 
                                    $vivotSum[$el['nip']]['jumlah_jam_rumus'] = $vivotSum[$el['nip']]['jumlah_jam_rumus'] + $el['jumlah_jam_rumus']; 
                                }
                            }
                            
                            $results = array_merge($vivotSum, $results);

                };
                
                $result = $results;
            }
        }
        
        return $result;
    }
    
    public function actionPivotmodule()
    {
        
        return $this->render('pivotmodule', [
            
        ]);
    }
    
    public function actionJsonreportpivotmodule(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $results = [];
        $vivotSum = [];
        
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $start_date = Yii::$app->request->get('start_date');
                $end_date = Yii::$app->request->get('end_date');
                
                if(!empty($start_date) && !empty($end_date)){
                    
                    $start_date = date('Y-m-d', strtotime($start_date));
                    $end_date = date('Y-m-d', strtotime($end_date));
                    
                    $query = (new \yii\db\Query())
                                ->select(['ij.id', 'ij.nip', 'ij.nama_dosen', 'ij.nama_fakultas', 
                                            'IfNull(ij.nama_dosen_digantikan, "-") AS nama_dosen_digantikan',
                                            new \yii\db\Expression('CASE '
                                                                    . 'WHEN ij.nama_fakultas_digantikan IS NULL THEN "-" '
                                                                    . 'WHEN ij.nama_fakultas_digantikan = "" THEN "-" '
                                                                    . 'ELSE ij.nama_fakultas_digantikan '
                                                                    . 'END AS nama_fakultas_digantikan'),
                                            'ij.nama_module', 'ij.module_id', 'ij.nama_kelas', 'ij.nama_ruangan', 
                                            'DATE_FORMAT(ij.tgl_kegiatan, "%d %b %Y") AS tgl_kegiatan',
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_mulai,  "%H:%i") as jam_mulai'),
                                            new \yii\db\Expression('TIME_FORMAT(ij.jam_selesai,  "%H:%i") as jam_selesai'),
                                            'ij.nama_peran', 'ij.jumlah_jam_rumus', 'ij.transport', 'ij.honor', 'ij.keterangan'])
                                ->from('imbal_jasa ij')
                                ->where('ij.tgl_kegiatan >=:start_date AND ij.tgl_kegiatan <=:end_date', 
                                            [':start_date' => $start_date, ':end_date' => $end_date])
                                ->orderBy('ij.tgl_kegiatan ASC')
                                ->createCommand();

                            $results = $query->queryAll();
                            
                            $honor = 0;
                            $transport = 0;
                            
                            if(!empty($results)){
                                foreach ($results as $i=>$res):
                                    $honor+=$res['honor'];
                                    $transport+=$res['transport'];
                                endforeach;
                            };
                            
                            foreach ($results as $el) {
                                if (!array_key_exists($el['module_id'], $vivotSum)) {
                                    $vivotSum[$el['module_id']] = array(
                                        'id' => 'nip',
                                        'nip' => $el['nip'],
                                        'nama_dosen' => $el['nama_dosen'],
                                        'nama_fakultas' => $el['nama_fakultas'],
                                        'nama_dosen_digantikan' => $el['nama_dosen_digantikan'],
                                        'nama_fakultas_digantikan' => $el['nama_fakultas_digantikan'],
                                        'nama_module' => $el['nama_module'],
                                        'module_id' => $el['module_id'],
                                        'nama_kelas' => $el['nama_kelas'],
                                        'nama_ruangan' => $el['nama_ruangan'],
                                        'tgl_kegiatan' => 'Total',
                                        'jam_mulai' => $el['jam_mulai'],
                                        'jam_selesai' => $el['jam_selesai'],
                                        'nama_peran' => $el['nama_peran'],
                                        'jumlah_jam_rumus' => $el['jumlah_jam_rumus'],
                                        'honor' =>  $el['honor'],
                                        'transport' =>  $el['transport'],
                                        'keterangan' => $el['keterangan']
                                    );
                                } else {
                                    $vivotSum[$el['module_id']]['honor'] = $vivotSum[$el['module_id']]['honor'] + $el['honor']; 
                                    $vivotSum[$el['module_id']]['transport'] = $vivotSum[$el['module_id']]['transport'] + $el['transport']; 
                                    $vivotSum[$el['module_id']]['jumlah_jam_rumus'] = $vivotSum[$el['module_id']]['jumlah_jam_rumus'] + $el['jumlah_jam_rumus']; 
                                }
                            }
                            
                            $results = array_merge($vivotSum, $results);

                };
                
                $result = $results;
            }
        }
        
        return $result;
    }
    
}
