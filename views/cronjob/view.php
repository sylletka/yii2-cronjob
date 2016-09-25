<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cronjob', 'Cronjobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cronjob', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cronjob', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cronjob', 'Are you sure you want to delete this item?'),
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
