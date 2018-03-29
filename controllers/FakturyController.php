<?php

namespace app\controllers;

use Yii;
use app\models\Faktury;
use app\models\ZpusobyPlatby;
use app\models\DetailPlatby;
use app\models\Platce;
use app\models\FakturySearch;
use app\models\Firmy;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * FakturyController implements the CRUD actions for Faktury model.
 */
class FakturyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
           
        ];
    }

    /**
     * Lists all Faktury models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FakturySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $bookId = Yii::$app->request->post('editableKey');
            $model = Faktury::findOne($bookId);

            // store a default json response as desired by editable

            $out = Json::encode(['output'=>'', 'message'=>'']);
            // fetch the first entry in posted data (there should only be one entry
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['Faktury']);
            $post = ['Faktury' => $posted];

            /*
            $out = Json::encode(['output'=>'', 'message'=>var_export($post, true)]);
            echo $out;
            return;
*/



            if (isset($posted['dph'])) {
                $post['Faktury']['vc_dph']=$posted['dph']+$model->bez_dph;
            }
            if (isset($posted['bez_dph'])) {
                $post['Faktury']['vc_dph']=$posted['bez_dph']+$model->dph;
            }


    //  if (is_array($post['Faktury']['detaily_ids'])) $post['Faktury']['detaily']=$post['Faktury']['detaily_ids'];
            /*
            $out = Json::encode(['output'=>'', 'message'=>var_export($post, true)]);
            echo $out;
            return;
*/
            // load model like any single model validation
            if ($model->load($post)) {

/*
                $out = Json::encode(['output'=>'ds', 'message'=>'']);
                echo $out;
                return;
*/


                // can save model or do something before saving model
                $model->save();
                //$model->save(false);  // withou validation for test

                /*
                $out = Json::encode(['output'=>'ds', 'message'=>var_export($post, true)]);
                echo $out;
                return;
*/
                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model

                if (isset($posted['zpusob_platby'])) {
                    $output = ZpusobyPlatby::findOne($posted['zpusob_platby'])->nazev_zpusob;
                }
                if (isset($posted['platce'])) {
                    $output = Platce::findOne($posted['platce'])->nazev_platce;
                }

                if (isset($posted['spolecnost'])) {
                    $output = Firmy::findOne($posted['spolecnost'])->nazev_firmy;
                }

                if (isset($posted['datum_platby'])) {
                    $output = date("d.m.Y", strtotime($posted['datum_platby']));
                }

                if (isset($posted['datum_zp'])) {
                    $output = date("d.m.Y", strtotime($posted['datum_zp']));
                }




                if (isset($posted['detaily_ids']) && is_array($posted['detaily_ids'])) {
                    $res='';
                    foreach ($posted['detaily_ids'] as $det_id) {
                        $res.= DetailPlatby::findOne($det_id)->nazev_platby.", ";
                    }
                    $res=rtrim($res, ', ');
                    $output = $res;
                }


                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faktury model.
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
     * Creates a new Faktury model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faktury();

        if ($model->load(Yii::$app->request->post())) {

            $model->vc_dph=$model->dph+$model->bez_dph;
           // die(var_export($model->save()->rawSql, true));
            if  ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Faktury model.
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
     * Deletes an existing Faktury model.
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
     * Finds the Faktury model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faktury the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faktury::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
