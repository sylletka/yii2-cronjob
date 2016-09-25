<?php

namespace app\commands;

use yii;
use yii\console\Controller;
use sylletka\cronjob\models\Cronjob;

class CronController extends Controller
{
    public function actionIndex()
    {
        $cronjobs = Cronjob::find()
            ->joinWith('cronjobHours')
            ->joinWith('cronjobMinutes')
            ->joinWith('cronjobDays')
            ->joinWith('cronjobDayOfWeeks')
            ->joinWith('cronjobMonths')
            ->andWhere(['or',['cronjob_minute.value' => "*"],['cronjob_minute.value' => date('i')]])
            ->andWhere(['or',['cronjob_hour.value' => "*"],['cronjob_hour.value' => date('H')]])
            ->andWhere(['or',['cronjob_day.value' => "*"],['cronjob_day.value' => date('d')]])
            ->andWhere(['or',['cronjob_day_of_week.value' => "0"],['cronjob_day_of_week.value' => date('w')]])
            ->andWhere(['or',['cronjob_month.value' => "*"],['cronjob_month.value' => date('m')]])
            ->all();
        foreach ($cronjobs as $cronjob) {
            $command = new $cronjob->cron_command;
            $command->exec($cronjob->params);
        }
    }
}

