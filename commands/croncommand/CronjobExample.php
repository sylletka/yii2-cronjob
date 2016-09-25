<?php

namespace sylletka\cronjob\commands\croncommand;

use yii;
use yii\base\Object;

class CronjobExample extends Object implements CronCommandInterface
{
    public function exec($params = null)
    {
        Yii::info('cronjob executed');
    }
}
