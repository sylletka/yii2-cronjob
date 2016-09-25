<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\chosen\Chosen;

/* @var $this yii\web\View */
/* @var $model app\models\gestione\Cronjob */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$cronoptions = [
    'cronjobMinutes' => ['min' => 0 , 'max' => 59],
    'cronjobHours' => ['min' => 0 , 'max' => 23],
    'cronjobDays' => ['min' => 1 , 'max' => 31],
    'cronjobMonths' => ['min' => 1 , 'max' => 12],
];
?>

<div class="cronjob-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $form->field( $model, 'cron_command' )->textInput() ?>
    </div>
    <div class="row">
        <?php foreach ( $cronoptions as $attribute => $number ): ?>
            <?php 
                $range = range($number['min'], $number['max']);
                array_walk($range, function(&$value, $key) {
                    $value = str_pad($value, 2, '0', STR_PAD_LEFT);;
                });
                $options = array_merge(['*'], $range);
                $items = array_combine( $options, $options);
                $values = [];
                foreach ($model->$attribute as $related){
                    $values[] = $related->value;
                }
            ?>
            <div class="col-md-2">
                <?= Html::activeLabel( $model,  $attribute );?>
                <?= Chosen::widget([
                        'name' => "Cronjob[$attribute][]",
                        'value' => $values,
                        'items' => $items,
                        'multiple' => true,
                        'placeholder' => '*',
                    ]);
                ?>
            </div>
        <?php endforeach; ?>
        <div class="col-md-2">
            <?php            
                $values = [];
                foreach ($model->cronjobDayOfWeeks as $related){
                    $values[] = $related->value;
                }
                $days_of_week = array_merge(['*'], $model->listDaysOfWeek());
            ?>
            <?= Html::activeLabel( $model, 'cronjobDayOfWeeks' );?>
            <?= Chosen::widget([
                    'name' => "Cronjob[cronjobDayOfWeeks][]",
                    'value' => $values,
                    'items' => $days_of_week,
                    'multiple' => true,
                    'placeholder' => '*',
                ]);
            ?>
        </div>
    </div>
    <div class="row">
        <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('gestione', 'Create') : Yii::t('gestione', 'Update'), 
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
