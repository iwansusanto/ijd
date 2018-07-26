<?php

namespace backend\controllers;

use Yii;
use app\models\Noteijd;
use app\models\NoteijdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoteijdController implements the CRUD actions for Noteijd model.
 */
class NoteijdController extends Controller
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
     * Lists all Noteijd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoteijdSearch();
        $searchModel->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noteijd model.
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
     * Creates a new Noteijd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noteijd();
        $no_urut = [];
        $disable_value = [];
        $no_urut = Yii::$app->is->urut_100();
        
        $noteIjd = Noteijd::find()
                    ->select('no_urut')
                    ->where('tahun_ajaran_id=:tahun_ajaran_id', [
                                ':tahun_ajaran_id'  =>  Yii::$app->is->tahunAjaran()->id
                    ])
                    ->asArray()
                    ->all();
        if(!empty($noteIjd)){
            foreach ($noteIjd as $x=>$data):
                $disable_value[$data['no_urut']] = [
                        'disabled' => 'true'];
            endforeach;
        };
        
//        echo '<pre>';print_r($disable_value);die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'no_urut'  =>  $no_urut,
            'disable_value'    =>  $disable_value
        ]);
    }

    /**
     * Updates an existing Noteijd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $no_urut = [];
        $disable_value = [];
        $no_urut = Yii::$app->is->urut_100();
        
        $noteIjd = Noteijd::find()
                    ->select('no_urut')
                    ->where('tahun_ajaran_id=:tahun_ajaran_id AND id<>:id', [
                                ':tahun_ajaran_id'  =>  Yii::$app->is->tahunAjaran()->id,
                                ':id'   =>  $id
                    ])
                    ->asArray()
                    ->all();
        if(!empty($noteIjd)){
            foreach ($noteIjd as $x=>$data):
                $disable_value[$data['no_urut']] = [
                        'disabled' => 'true'];
            endforeach;
        };

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'no_urut'  =>  $no_urut,
            'disable_value'    =>  $disable_value
        ]);
    }

    /**
     * Deletes an existing Noteijd model.
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
     * Finds the Noteijd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noteijd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noteijd::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
