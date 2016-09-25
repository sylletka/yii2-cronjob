<?php

namespace sylletka\cronjob\models\gestione;

use Yii;

/**
 * This is the model class for table "cronjob_day_of_week".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob
 */
class CronjobDayOfWeek extends CronjobElement
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cronjob_day_of_week';
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
