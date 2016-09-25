# yii2-cronjob
This module provides pages and commands to manage and run cron jobs

##Install

1. enable the module in config file

    ```php
    <?php
        'modules' => [
            ...
            'log' => [
                'class' => 'sylletka\cronjob\Module',
            ],
            ...
        ],


