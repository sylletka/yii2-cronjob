<?php

use yii\helpers\Html;

$this->title = Yii::t('cronjob', 'Update {modelClass}: ', [
    'modelClass' => 'Cronjob',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cronjob', 'Cronjobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cronjob', 'Update');
?>
<div class="cronjob-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
