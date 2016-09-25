<?php

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = Yii::t('cronjob', 'Create Cronjob');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cronjob', 'Cronjobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
