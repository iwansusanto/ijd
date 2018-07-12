<?php

namespace backend\controllers;

use Yii;
use app\models\Dosenfakultas;
use app\models\TahunAjaran;
use app\models\Dosen;
use app\models\Fakultas;
use app\models\DosenfakultasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;

/**
 * DosenfakultasController implements the CRUD actions for Dosenfakultas model.
 */
class DosenfakultasController extends Controller
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
     * Lists all Dosenfakultas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenfakultasSearch();
        $searchModel->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dosenfakultas model.
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
     * Creates a new Dosenfakultas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dosenfakultas();
        $model->scenario = \app\models\DosenFakultas::SCENARIOCREATE;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatetemplate(){
        
        $session = Yii::$app->session;
        
        $tahunAjaran = TahunAjaran::findOne($session->get('template_tahun_ajaran_id'));
        $dosen = Dosen::find()->asArray()->all();
        $fakultas = Fakultas::find()->asArray()->all();
        
        if(Yii::$app->request->isAjax){
//            $count = count(Yii::$app->request->post('DosenFakultas', []));
//            for($i = 0; $i < $count; $i++): // using foreach Yii::$app->request->post() to get index
//                $model[] = new \app\models\DosenFakultas(['scenario'    =>  'scenariomultiple']);
//            endfor;
            
            foreach (Yii::$app->request->post('DosenFakultas') as $i=>$row): // using foreach Yii::$app->request->post() to get index
                $model[$i] = new \app\models\DosenFakultas(['scenario'    =>  'scenariomultiple']);
            endforeach;
            
            if(\yii\base\Model::loadMultiple($model, Yii::$app->request->post())) {
            
                if(\yii\base\Model::validateMultiple($model)){
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    foreach ($model as $row) {
                        $row->tahun_ajaran_id = Yii::$app->is->tahunAjaran()->id;
                        $row->save(false);
                    };
                    
                    return [
                        'success'   =>  true,
                        'url_redirect'  =>  Url::to(['dosenfakultas/index'])
                    ];
                    
                } else {
                    Yii::$app->response->statusCode = 400;
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    
                    return \yii\widgets\ActiveForm::validateMultiple($model);
                };
                
//            Yii::$app->end();
//            https://www.yiiframework.com/doc/guide/2.0/en/input-tabular-input#updating-a-fixed-set-of-records
            }
        }
        
        $model = \app\models\DosenFakultas::find()
                    ->where('tahun_ajaran_id=:tahun_ajaran_id',[
                        ':tahun_ajaran_id'  =>  $tahunAjaran->id
                    ])
                    ->all();
        
        return $this->render('createtemplate', [
            'model' => $model,
            'dosen' =>  $dosen,
            'fakultas' =>  $fakultas,
            'tahunAjaran'  =>  $tahunAjaran
        ]);
    }

    /**
     * Updates an existing Dosenfakultas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = \app\models\DosenFakultas::SCENARIOUPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dosenfakultas model.
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
     * Finds the Dosenfakultas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dosenfakultas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosenfakultas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionSessiontemplate(){
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        
        $model = new TahunAjaran();
        
        if(Yii::$app->request->isAjax){
            
            if ($model->load(Yii::$app->request->post())) {
                $session = Yii::$app->session;
                
                if(!empty($model->id)){
                    $session['template_tahun_ajaran_id'] = $model->id;
                    
                    $result = [
                                'success'   =>  true,
                                'url_redirect'   => Url::to(['dosenfakultas/createtemplate'])
                            ];
                    
                } else {
                    Yii::$app->response->statusCode = 400;
                    $result = [
                        'success'   =>  false,
                        'url_redirect'   =>  false
                    ];
                }
                
            }
        };
        
        return $result;
    }
    
    public function actionAdddosenrow(){
        
        $count = Yii::$app->request->post('count');
        $dosen = Dosen::find()->asArray()->all();
        $fakultas = Fakultas::find()->asArray()->all();
        
        return $this->renderAjax('ajax_adddosenrow', [
            'dosen' => $dosen,
            'fakultas' =>  $fakultas,
            'count'    =>  $count
        ]);
    }
}
