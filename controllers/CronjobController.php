<?php

namespace sylletka\cronjob\controllers;

use Yii;
use sylletka\cronjob\models\Cronjob;
use sylletka\cronjob\models\CronjobElement;
use sylletka\cronjob\models\CronjobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CronjobController implements the CRUD actions for Cronjob model.
 */
class CronjobController extends Controller
{

    /**
     * Lists all Cronjob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CronjobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Cronjob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Cronjob();
        if ($model->load($post) && $model->save()){
            foreach ($model->relationMap as $key => $attribute){
                if (array_key_exists($attribute, $post['Cronjob'])){
                    $values = $post['Cronjob'][$attribute];
                } else {
                    $values = ["*"];
                }
                foreach ($values as $value) {
                    $cronjobElement = new CronjobElement();
                    $cronjobElement->key = $key;
                    $cronjobElement->value = $value;
                    $cronjobElement->link('cronjob', $model);
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cronjob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            foreach ($model->relationMap as $key => $attribute){
                if (array_key_exists($attribute, $post['Cronjob'])){
                    $values = $post['Cronjob'][$attribute];
                } else {
                    $values = ["*"];
                }
                foreach ($values as $value) {
                    $cronjobElement = new CronjobElement();
                    $cronjobElement->key = $key;
                    $cronjobElement->value = $value;
                    $cronjobElement->link('cronjob', $model);
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cronjob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cronjob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cronjob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cronjob::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Saves the models
     * @param Cronjob $model
     * @param array $data the posted data
     * @return boolean true if the model was successfully saved
    */
    protected function saveModel($model, $data)
    {
        if ($model->load($data) && $model->save()){
            foreach ($model->relationMap as $key => $attribute){
                if (array_key_exists($attribute, $post['Cronjob'])){
                    $values = $post['Cronjob'][$attribute];
                } else {
                    $values = ["*"];
                }
                foreach ($values as $value) {
                    $cronjobElement = new CronjobElement();
                    $cronjobElement->key = $key;
                    $cronjobElement->value = $value;
                    try {
                        $cronjobElement->link('cronjob', $model);
                    } catch (Exception $e) {
                        CronjobElement::deleteAll(['cronjob' => $model->id]);
                        $model->delete();
                        throw new InvalidCallException($e->getMessage());
                    }
                }
            }
        } else {
            throw new InvalidCallException('Unable to save model');
        }
    }

}
