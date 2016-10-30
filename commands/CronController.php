<?php

namespace sylletka\cronjob\commands;

use yii;
use yii\console\Controller;
use sylletka\cronjob\models\Cronjob;

class CronController extends Controller
{
    public function actionIndex()
    {
        $cronjobs = Cronjob::find()
            ->joinWith('cronjobHours hours')
            ->joinWith('cronjobMinutes minutes')
            ->joinWith('cronjobDays days')
            ->joinWith('cronjobDayOfWeeks day_of_weeks')
            ->joinWith('cronjobMonths months')
            ->andWhere(['or',['minutes.value' => "*"],['minutes.value' => date('i')]])
            ->andWhere(['or',['hours.value' => "*"],['hours.value' => date('H')]])
            ->andWhere(['or',['days.value' => "*"],['days.value' => date('d')]])
            ->andWhere(['or',['day_of_weeks.value' => "*"],['day_of_weeks.value' => date('w')]])
            ->andWhere(['or',['months.value' => "*"],['months.value' => date('m')]])
            ->all();
        foreach ($cronjobs as $cronjob) {
            $command = new $cronjob->cron_command;
            $command->exec($cronjob->params);
        }
    }
}
