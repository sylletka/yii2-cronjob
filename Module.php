<?php

namespace sylletka\cronjob;

/**
 * log module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'sylletka\cronjob\controllers';

    /**
     * @var string the DB application component ID of the DB connection.
     */
    public $db = 'db';
}

