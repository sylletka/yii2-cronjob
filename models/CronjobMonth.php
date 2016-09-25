<?php

namespace sylletka\cronjob\models;

use Yii;

/**
 * This is the model class for table "cronjob_month".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob
 */
class CronjobMonth extends CronjobElement
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronjob_month';
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
