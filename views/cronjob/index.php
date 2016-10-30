<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

$this->title = Yii::t('cronjob', 'Cronjobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('cronjob', 'Create Cronjob'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
        GridView::widget([
            'showHeader' => false,
            'dataProvider' => $dataProvider,
            'columns' =>[
                [
                    'content' => function($model, $key, $index, $column){
                        return "<code>" . $model->crontabString . "</code>";
                    }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    ?>
</div>
