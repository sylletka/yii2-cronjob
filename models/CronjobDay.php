<?php

namespace sylletka\cronjob\models\gestione;

use Yii;

/**
 * This is the model class for table "cronjob_day".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob0
 */
class CronjobDay extends CronjobElement
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronjob_day';
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
