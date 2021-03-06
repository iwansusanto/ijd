<?php

namespace backend\controllers;

use Yii;
use app\models\ModuleTahunAjaran;
use app\models\ModuleTahunAjaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModuletahunajaranController implements the CRUD actions for ModuleTahunAjaran model.
 */
class ModuletahunajaranController extends Controller
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
     * Lists all ModuleTahunAjaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleTahunAjaranSearch();
        $searchModel->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleTahunAjaran model.
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
     * Creates a new ModuleTahunAjaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleTahunAjaran();

        if ($model->load(Yii::$app->request->post())) {
//            echo '<pre>';            print_r(Yii::$app->request->post());die;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        
        $model->jumlah_sks = ModuleTahunAjaran::jumlah_sks;
        $model->jumlah_menit_per_sks = ModuleTahunAjaran::jumlah_menit_per_sks;
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModuleTahunAjaran model.
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
     * Deletes an existing ModuleTahunAjaran model.
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
     * Finds the ModuleTahunAjaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleTahunAjaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleTahunAjaran::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
