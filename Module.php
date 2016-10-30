<?php

namespace sylletka\cronjob;

use Yii;

/**
 * log module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the DB application component ID of the DB connection.
     */
    public $db = 'db';

    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'sylletka\cronjob\commands';
        } else {
            $this->controllerNamespace = 'sylletka\cronjob\controllers';
        }
    }
}
