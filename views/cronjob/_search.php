<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gestione\CronjobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cronjob-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cron_command') ?>

    <?= $form->field($model, 'minute') ?>

    <?= $form->field($model, 'hour') ?>

    <?= $form->field($model, 'day') ?>

    <?php // echo $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'day_of_week') ?>

    <?php // echo $form->field($model, 'params') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('gestione', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('gestione', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
