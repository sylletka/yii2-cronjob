# yii2-cronjob
This module provides pages and commands to manage and run cron jobs
##Install
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sylletka/yii2-cronjob "*"
```

or add

```
"sylletka/yii2-cronjob": "*"
```

to the require section of your `composer.json` file.

Subsequently, run

```php
./yii migrate/up --migrationPath=@vendor/sylletka/yii2-cronjob/migrations
```

in order to create the required tables.

Then, enable the module in config file:

```php
<?php
    'modules' => [
        ...
        'log' => [
            'class' => 'sylletka\cronjob\Module',
        ],
        ...
    ],
```
