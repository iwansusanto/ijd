<?php

namespace backend\controllers;

use Yii;
use app\models\Transaksi;
use app\models\TransaksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Module;
use app\models\ImbalJasa;
use yii\web\Response;
use app\models\Kelas;
use app\models\Ruangan;
use app\models\Peran;

/**
 * TRansaksiController implements the CRUD actions for Transaksi model.
 */
class TransaksiController extends Controller
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
     * Lists all Transaksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaksi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaksi();

        if ($model->load(Yii::$app->request->post())) {
            
            $transaksi = Transaksi::find()
                            ->where([
                                'SUBSTRING(no_transaksi, 1, 4)'  => date('Y')
                            ])
                            ->orderBy('id DESC')
                            ->one();
            
            $no_urut = "001";
            if(!empty($transaksi)){
                $no_urut = substr($transaksi->no_transaksi, 11, 3);
                $no_urut = (int)$no_urut+1;
                $no_urut = str_pad($no_urut, 3, "0", STR_PAD_LEFT);
            }
            
            $model->no_transaksi = date('Ym', strtotime($model->bulan_tahun)).'/IJD/'.$no_urut;
            
            if($model->save()){
//                return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transaksi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->bulan_tahun = date('Y-m', strtotime($model->bulan_tahun));
                
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transaksi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
    
    public function actionImbaljasa($id)
    {
        $model = $this->findModel($id);
        
        $module = Module::find()
                    ->where([])
                    ->all();
        
        $session = Yii::$app->session;
        $session['bulan_tahun'] = $model->bulan_tahun;
        
        return $this->render('imbaljasa', [
            'model' => $model,
            'module'    =>  $module
        ]);
    }
    
    public function actionJsonimbaljasa(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $result = [];
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $module_id = Yii::$app->request->get('module_id');
                
                $result = ImbalJasa::find()
                    ->select('id, nip')
                    ->where([
                        'module_id' =>  $module_id
                    ])
                    ->orderBy('id DESC')
                    ->all();
            }
        }
        
        
        return $result;
    }
    
//    public function actionJsonmodule(){
//        
//        Yii::$app->response->format = Response::FORMAT_JSON;
//        $model = (new \yii\db\Query())
//                    ->select(['mk.module_id', 'mk.kelas_id', 'mk.tahun_ajaran_id', 'm.nama as module'])
//                    ->from('module_kelas mk')
//                    ->join('LEFT JOIN', 'module m', 'mk.module_id = m.id')
//                    ->where('mk.tahun_ajaran_id=:tahun_ajaran_id', [':tahun_ajaran_id' => Yii::$app->is->tahunAjaran()->id])
//                    ->groupBy('mk.module_id')
//                    ->createCommand();
//        
//        return $model->queryAll();
//    }
    public function actionJsonmodule(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = (new \yii\db\Query())
                    ->select(['ph.id', 'ph.module_id', 'ph.tahun_ajaran_id', 'm.nama as module'])
                    ->from('peran_hitung ph')
                    ->join('LEFT JOIN', 'module m', 'ph.module_id = m.id')
                    ->where('ph.tahun_ajaran_id=:tahun_ajaran_id AND ph.bulan=:bulan AND ph.tahun=:tahun', [
                                ':tahun_ajaran_id' => Yii::$app->is->tahunAjaran()->id,
                                ':bulan' => (int)Yii::$app->is->bulanhitung(),
                                ':tahun' => (int)Yii::$app->is->tahunhitung()])
                    ->groupBy('ph.module_id')
                    ->createCommand();
        
        return $model->queryAll();
    }
    
    public function actionJsonlihatkelas(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $result = [];
        
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->isGet){
                $module_id = Yii::$app->request->get('module_id');
                
                $model = (new \yii\db\Query())
                    ->select(['mk.module_id', 'mk.kelas_id', 'mk.tahun_ajaran_id', 'm.nama as module', 'k.nama as kelas'])
                    ->from('module_kelas mk')
                    ->join('LEFT JOIN', 'module m', 'mk.module_id = m.id')
                    ->join('LEFT JOIN', 'kelas k', 'mk.kelas_id = k.id')
                    ->where('mk.tahun_ajaran_id=:tahun_ajaran_id AND mk.module_id=:module_id', 
                                [':tahun_ajaran_id' => Yii::$app->is->tahunAjaran()->id,
                                 ':module_id' => $module_id])
                    ->createCommand();
        
                $result = $model->queryAll();
            }
        }
        
        
        return $result;
    }
    
    public function actionJsonkelas(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Kelas::find()
                    ->all();
        
        return $model;
    }
    
    public function actionJsonruang(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Ruangan::find()
                    ->all();
        
        return $model;
    }
    
    public function actionJsonperan(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = (new \yii\db\Query())
                    ->select(['ph.id', 'ph.peran_id', 'ph.tahun_ajaran_id', 'p.nama as peran'])
                    ->from('peran_hitung ph')
                    ->join('LEFT JOIN', 'peran p', 'ph.peran_id = p.id')
                    ->where('ph.tahun_ajaran_id=:tahun_ajaran_id AND ph.bulan=:bulan AND ph.tahun=:tahun', [
                                ':tahun_ajaran_id' => Yii::$app->is->tahunAjaran()->id,
                                ':bulan' => (int)Yii::$app->is->bulanhitung(),
                                ':tahun' => (int)Yii::$app->is->tahunhitung()])
                    ->groupBy('ph.peran_id')
                    ->createCommand();
        
        return $model->queryAll();
    }
    
    public function actionDosenfakultas(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = (new \yii\db\Query())
                    ->select(['df.id', 'df.dosen_id', 'df.fakultas_id', 'df.tahun_ajaran_id', 'd.nip', 'd.nama as dosen', 'f.nama as fakultas'])
                    ->from('dosen_fakultas df')
                    ->join('LEFT JOIN', 'dosen d', 'df.dosen_id = d.id')
                    ->join('LEFT JOIN', 'fakultas f', 'df.fakultas_id = f.id')
                    ->where('df.tahun_ajaran_id=:tahun_ajaran_id', [':tahun_ajaran_id' => Yii::$app->is->tahunAjaran()->id])
                    ->createCommand();
        
        return $model->queryAll();
    }
    
    public function actionSave(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        
        $model = new ImbalJasa();
        
        if(Yii::$app->request->isAjax){
            
            if ($model->load(Yii::$app->request->post())) {
                
//                $model->peran_hitung_id = 2;
                
                if($model->save()){
                    $result = [
                        'success'   =>  true,
                        'message'   =>  'Insert Data Success'
                    ];
                } else {
                    Yii::$app->response->statusCode = 400;
                    $result = [
                        'success'   =>  false,
                        'message'   =>  $model->errors
                    ];
                    
                }
            }
        };
//        $data = Yii::$app->request->post('ImbalJasa');
//        echo '<pre>';        print_r($data);
        
        return $result;
    }
    
    
    public function actionHitungimbaljasa(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        $model = new ImbalJasa();
        
        if(Yii::$app->request->isAjax){
            
            if ($model->load(Yii::$app->request->post())) {
                
                $result = [
                        'success'   =>  true,
                        'datas'  =>  [
                            'transport'   =>  10000,
                            'honor'   =>  5000,
                            'peran_hitung_id'   =>  12,
                        ]
                    ];
                
            };
            
        };
        
        return $result;
    }
}
