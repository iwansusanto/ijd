<?php

namespace backend\controllers;

use Yii;
use app\models\PeranHitung;
use app\models\PeranHitungSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\ModuleTahunAjaran;
use yii\helpers\ArrayHelper;

/**
 * PeranhitungController implements the CRUD actions for PeranHitung model.
 */
class PeranhitungController extends Controller
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
            'access' => [
                'class' => 'mdm\admin\components\AccessControl',
            ]
        ];
    }

    /**
     * Lists all PeranHitung models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeranHitungSearch();
        $searchModel->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
//        print_r($searchModel->search(Yii::$app->request->queryParams));die;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PeranHitung model.
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
     * Creates a new PeranHitung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PeranHitung();
        $model->bulan = date('Y-m');
        $data = [];
        $moduleTahunAjaran = [];
        
        if ($model->load(Yii::$app->request->post())) {
            
//            $request = Yii::$app->request->post('PeranHitung');

            if($model->save()){
//                return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            }
            
        }
        

//        $model->jumlah_sks = PeranHitung::jumlah_sks;
//        $model->jumlah_menit_per_sks = PeranHitung::jumlah_menit_per_sks;
        $model->volume_menit_pertemuan = PeranHitung::volume_menit_pertemuan;
        
        $moduleTahunAjaran = ModuleTahunAjaran::find()
                                    ->select(['module_tahun_ajaran.id', 'module.nama'])
                                    ->where('semester_id=:semester_id AND tahun_ajaran_id=:tahun_ajaran_id', [
                                            ':semester_id' => $model->semester_id,
                                            ':tahun_ajaran_id'   =>Yii::$app->is->tahunAjaran()->id])
                                    ->joinWith('module')
                                    ->orderBy('id DESC')
                                    ->asArray()
                                    ->all();
        
        if(!empty($moduleTahunAjaran)){
            $data = ArrayHelper::map($moduleTahunAjaran, 'id', 'nama');
        }
        
        
        return $this->render('create', [
            'model' => $model,
            'data' =>  $data
        ]);
    }

    /**
     * Updates an existing PeranHitung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->bulan = date('Y-m', strtotime($model->tahun.'-'.$model->bulan));
        $model->volume_menit_pertemuan = $model->volume_menit_pertemuan/60;
        
        $moduleTahunAjaran = ModuleTahunAjaran::find()
                                    ->select(['module_tahun_ajaran.id', 'module.nama'])
                                    ->where('semester_id=:semester_id AND tahun_ajaran_id=:tahun_ajaran_id', [
                                            ':semester_id' => $model->semester_id,
                                            ':tahun_ajaran_id'   =>Yii::$app->is->tahunAjaran()->id])
                                    ->joinWith('module')
                                    ->orderBy('id DESC')
                                    ->asArray()
                                    ->all();
        
        if(!empty($moduleTahunAjaran)){
            $data = ArrayHelper::map($moduleTahunAjaran, 'id', 'nama');
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
            $request = Yii::$app->request->post('PeranHitung');
            $model->bulan = date('Y-m', strtotime($request['bulan']));
            
            if($model->save()){
//                return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            };
        }
        
        
        
//        print_r($model->bulan);die;
        return $this->render('update', [
            'model' => $model,
            'data' =>  $data
        ]);
    }

    /**
     * Deletes an existing PeranHitung model.
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
     * Finds the PeranHitung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PeranHitung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PeranHitung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionLihatmodulebysemester(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PeranHitung();
        $results = [];
        
        if(Yii::$app->request->isAjax){
            
            if ($model->load(Yii::$app->request->post())) {
                
                $moduleTahunAjaran = ModuleTahunAjaran::find()
                                                    ->where('semester_id=:semester_id AND tahun_ajaran_id=:tahun_ajaran_id', [
                                                            ':semester_id' => $model->semester_id,
                                                            ':tahun_ajaran_id'   =>Yii::$app->is->tahunAjaran()->id])
                                                    ->orderBy('id DESC')
                                                    ->all();
                
                if (!empty($moduleTahunAjaran)) {
                    foreach($moduleTahunAjaran as $data) {
				$results[] = "<option value='".$data->id."'>".$data->nama."</option>";
			}
                } else {
                    $results = "<option>-</option>";
                }
            }
            
            return $results;
            
        }
    }
}
