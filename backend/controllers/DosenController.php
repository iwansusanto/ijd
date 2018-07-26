<?php

namespace backend\controllers;

use Yii;
use app\models\Dosen;
use app\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;
use yii\web\UploadedFile;

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
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
     * Lists all Dosen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $field = [
//            'fileImport'    =>  'File Import'
//        ];
//        
//        $modelImport = DynamicModel::validateData($field, [
//            [['fileImport'], 'required'],
//            [['fileImport'], 'file', 'extensions'   =>  'xls, xlsx', 'maxSize'  =>  1024*1024],
//        ]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'modelImport'   => $modelImport
        ]);
    }

    /**
     * Displays a single Dosen model.
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
     * Creates a new Dosen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dosen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dosen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dosen model.
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
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosen::findOne($id)) !== null) {
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
                    $model = new Dosen();
                    $model->nip = (string)$sheetData[$baseRow]['C'];
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
}
