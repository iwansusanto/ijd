<?php

namespace backend\controllers;

use Yii;
use app\models\Kelas;
use app\models\KelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;
use yii\web\UploadedFile;

/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kelas model.
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
     * Creates a new Kelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kelas model.
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
     * Deletes an existing Kelas model.
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
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionImport(){
        
        $field = [
            'fileImport' => 'File Import'
        ];
        
        $modelImport = DynamicModel::validateData($field, [
           [['fileImport'], 'required'], 
           [['fileImport'], 'file', 'extensions'    =>  'xls, xlsx', 'maxSize'  =>  1024*1024], 
        ]);
        
        if(Yii::$app->request->post()){
            $modelImport->fileImport = UploadedFile::getInstance($modelImport, 'fileImport');
            
            if($modelImport->fileImport && $modelImport->validate()){
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcell = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcell->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
                $baseRow = 3;
                
                $connection = Yii::$app->db;
                
                while (!empty($sheetData[$baseRow]['B'])) {
                    $model = new Kelas();
                    $model->nama = (string)$sheetData[$baseRow]['B'];
                    
                    if($model->validate()){
                        $transaction = $connection->beginTransaction();
                        
                        try {
                            if($model->save(FALSE)){
                                $transaction->commit();
                                Yii::$app->getSession()->setFlash('success', 'Success');
                            }
                        } catch (Exception $ex) {
                            $transaction->rollBack();
                            Yii::$app->getSession()->setFlash('error', 'Error');
                        };
                    } else {
                        foreach ($model->errors as $i=>$errors):
                            foreach ($errors as $x=>$error):
                                Yii::$app->session->addFlash('error', $error);
                            endforeach;
                        endforeach;
                    };
                    
                    $baseRow++;
                };
                
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
            }    
        }
        
        return $this->render('import', [
            'modelImport'   =>  $modelImport
        ]);
    }
    
    public function actionDownload(){
        $path = Yii::getAlias('@webroot').'/template/kelas.xlsx';
        
        if(file_exists($path))
            return Yii::$app->response->sendFile($path);
        else
            throw new CHttpException(404,'The requested file does not exists.');
    }
}
