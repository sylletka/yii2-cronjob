<?php

namespace app\controllers\gestione;

use Yii;
use app\models\gestione\Cronjob;
use app\models\gestione\CronjobDayOfWeek;
use app\models\gestione\CronjobDay;
use app\models\gestione\CronjobMinute;
use app\models\gestione\CronjobMonth;
use app\models\gestione\CronjobHour;
use app\models\gestione\CronjobSearch;
use app\controllers\GestioneController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CronjobController implements the CRUD actions for Cronjob model.
 */
class CronjobController extends GestioneController
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
     * Displays a single Cronjob model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cronjob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cronjob();
        if ( $post = Yii::$app->request->post()){
            $model->cron_command = $post['Cronjob']['cron_command'];
            $model->params = $post['Cronjob']['params'];
            if ( $model->save() ) {
                $cronjobId = $model->getPrimaryKey();
                if (array_key_exists('cronjobDayOfWeeks',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobDayOfWeeks'] as $value){
                        $related = new  CronjobDayOfWeek;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobDayOfWeek;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobDays',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobDays'] as $value){
                        $related = new  CronjobDay;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobDay;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobMonths',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobMonths'] as $value){
                        $related = new  CronjobMonth;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobMonth;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobHours',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobHours'] as $value){
                        $related = new  CronjobHour;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobHour;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                } 
                if (array_key_exists('cronjobMinutes',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobMinutes'] as $value){
                        $related = new  CronjobMinute;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobMinute;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }               
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
        $model = $this->findModel($id);
        if ( $post = Yii::$app->request->post()){
            $model->cron_command = $post['Cronjob']['cron_command'];
            $model->params = $post['Cronjob']['params'];
            if ( $model->save() ) {
                $cronjobId = $model->getPrimaryKey();
                CronjobDayOfWeek::deleteAll(['cronjob' => $cronjobId]);
                CronjobDay::deleteAll(['cronjob' => $cronjobId]);
                CronjobMinute::deleteAll(['cronjob' => $cronjobId]);
                CronjobMonth::deleteAll(['cronjob' => $cronjobId]);
                CronjobHour::deleteAll(['cronjob' => $cronjobId]);
                if (array_key_exists('cronjobDayOfWeeks',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobDayOfWeeks'] as $value){
                        $related = new  CronjobDayOfWeek;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobDayOfWeek;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobDays',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobDays'] as $value){
                        $related = new  CronjobDay;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobDay;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobMonths',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobMonths'] as $value){
                        $related = new  CronjobMonth;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobMonth;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }
                if (array_key_exists('cronjobHours',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobHours'] as $value){
                        $related = new  CronjobHour;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobHour;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                } 
                if (array_key_exists('cronjobMinutes',$post['Cronjob'])){
                    foreach ($post['Cronjob']['cronjobMinutes'] as $value){
                        $related = new  CronjobMinute;
                        $related->cronjob = $cronjobId;
                        $related->value = $value;
                        $related->save();
                    }
                } else {
                    $related = new CronjobMinute;
                    $related->cronjob = $cronjobId;
                    $related->value = "*";
                    $related->save();
                }          
            }
            return $this->redirect(['view', 'id' => $model->id]);
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
}
