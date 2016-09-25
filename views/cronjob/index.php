<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gestione\CronjobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('gestione', 'Cronjobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('gestione', 'Create Cronjob'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cron_command:ntext',
            [
                'attribute' => 'cronjobMinutes',
                'value' => function($dataProvider){
                    $out = [];
                    foreach ($dataProvider->cronjobMinutes as $model){
                        $out[] = $model->value;
                    } 
                    return implode(', ', $out);
                },
            ],
            [
                'attribute' => 'cronjobHours',
                'value' => function($dataProvider){
                    $out = [];
                    foreach ($dataProvider->cronjobHours as $model){
                        $out[] = $model->value;
                    } 
                    return implode(', ', $out);
                },
            ],
            [
                'attribute' => 'cronjobDays',
                'value' => function($dataProvider){
                    $out = [];
                    foreach ($dataProvider->cronjobDays as $model){
                        $out[] = $model->value;
                    } 
                    return implode(', ', $out);
                },
            ],
            [
                'attribute' => 'cronjobDayOfWeeks',
                'value' => function($dataProvider){
                    $out = [];
                    foreach ($dataProvider->cronjobDayOfWeeks as $model){
                        $out[] = $model->value;
                    } 
                    return implode(', ', $out);
                },
            ],
            [
                'attribute' => 'cronjobMonths',
                'value' => function($dataProvider){
                    $out = [];
                    foreach ($dataProvider->cronjobMonths as $model){
                        $out[] = $model->value;
                    } 
                    return implode(', ', $out);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
