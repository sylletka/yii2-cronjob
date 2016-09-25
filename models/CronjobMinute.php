<?php

namespace sylletka\cronjob\models;

use Yii;

/**
 * This is the model class for table "cronjob_minute".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob
 */
class CronjobMinute extends CronjobElement
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronjob_minute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cronjob', 'value'], 'required'],
            [['cronjob'], 'integer'],
            [['value'], 'string', 'max' => 2]
        ];
    }
}
