<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\gestione\Cronjob */

$this->title = Yii::t('gestione', 'Create Cronjob');
$this->params['breadcrumbs'][] = ['label' => Yii::t('gestione', 'Cronjobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
