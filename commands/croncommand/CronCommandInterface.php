<?php

namespace sylletka\cronjob\commands\croncommand;

use yii\base\Object;

interface CronCommandInterface
{
    public function exec($params = null);
}

