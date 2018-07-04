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
//        if(Yii::$app->request->isAjax){
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
//        }
        
        
        return $result;
    }
    
}
