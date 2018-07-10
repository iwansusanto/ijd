<?php

namespace backend\controllers;

use Yii;
use app\models\ModuleKelas;
use app\models\ModuleKelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\base\Model;
use app\models\Kelas;

/**
 * ModulekelasController implements the CRUD actions for ModuleKelas model.
 */
class ModulekelasController extends Controller
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
     * Lists all ModuleKelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleKelasSearch();
        $searchModel->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleKelas model.
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
     * Creates a new ModuleKelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new ModuleKelas();
//        
//        if ($model->load(Yii::$app->request->post())) {
//            
//            $save = false;
//            $connection = Yii::$app->db;
//            
//            $request = Yii::$app->request->post('ModuleKelas');
//            $kelas_arr = Yii::$app->request->post('ModuleKelas')['kelas_id'];
//            if(!empty($kelas_arr)){
//                foreach ($kelas_arr as $i=>$kls):
//                    
//                    $moduleKelas = new ModuleKelas();
//                    $moduleKelas->module_id = $request['module_id'];
//                    $moduleKelas->kelas_id = $kls;
//                    $moduleKelas->tahun_ajaran_id = $request['tahun_ajaran_id'];
//                    
//                    if($moduleKelas->validate()){
//                        $transaction = $connection->beginTransaction();
//                        
//                        try {
//                            if($moduleKelas->save(FALSE)){
//                                $transaction->commit();
//                                $save = true;
//                            }
//                        } catch (Exception $ex) {
//                            $transaction->rollBack();
//                            Yii::$app->getSession()->setFlash('error', 'Error');
//                        };
//                    } else {
//                        $model->addError('kelas_id', 'Kelas already exist');
//                        break;
//                    }
//                    
//                endforeach;
//            };
//            
//            if($save)
//                return $this->redirect(['index']);
//            
//            
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }
    
    public function actionCreate()
    {
        $model = new ModuleKelas();
        
        if($model->load(Yii::$app->request->post())) {
            
            $request = Yii::$app->request->post('ModuleKelas');
            $kelas_arr = $request['kelas_id'];
            
            $valid = false;
            $error = false;
            $transaction = Yii::$app->db->beginTransaction();
            
            try {
                
                if(!empty($kelas_arr)){
                    foreach ($kelas_arr as $i=>$kls):

                        $moduleKelas = new ModuleKelas();
                        $moduleKelas->module_id = $request['module_id'];
                        $moduleKelas->kelas_id = $kls;
                        $moduleKelas->tahun_ajaran_id = $request['tahun_ajaran_id'];

                        if($moduleKelas->validate()){
                            $valid = true;
                            if(!($valid = $moduleKelas->save(FALSE))){
                                break;
                            };
                            
                        } else {
                            $error = true;
                            $message_error[] = Kelas::findOne($kls)->nama;
//                            $valid = false;
//                            break;
                        }
                    endforeach;
                    
                    if($valid && !$error){
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        $model->addError('kelas_id', 'Kelas '. implode(', ', $message_error).' already exist');
                    }
                }
                
                
            } catch (Exception $ex) {
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash('error', 'Error');
            };
            
            // set kelas_id value
            $model->kelas_id = $kelas_arr;
        }

            
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModuleKelas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModuleKelas model.
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
     * Finds the ModuleKelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleKelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleKelas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionDeleteall() {
        
        if(Yii::$app->request->isPost){
            
            $ids = Yii::$app->request->post('ids');
            foreach ($ids as $key => $value){
                $this->findModel($value)->delete();
            };
            
        } else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        };
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return [
            'success'   =>  true
        ];
    }

}
