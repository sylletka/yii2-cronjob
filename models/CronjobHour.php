<?php

namespace sylletka\cronjob\models\gestione;

use Yii;

/**
 * This is the model class for table "cronjob_hour".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob
 */
class CronjobHour extends CronjobElement
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronjob_hour';
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
