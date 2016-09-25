<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\gestione\Cronjob */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('gestione', 'Cronjobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('gestione', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('gestione', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('gestione', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cron_command:ntext',
            'cronjobMinutesAsText',
            'cronjobHoursAsText',
            'cronjobDaysAsText',
            'cronjobDayOfWeeksAsText',
            'cronjobMonthsAsText',
            'params:ntext',
        ],
    ]) ?>

</div>
