<?php

namespace sylletka\cronjob\models;

use Yii;
use sylletka\cronjob\Module;

/**
 * This is the model class for table "cronjob_day".
 *
 * @property integer $id
 * @property integer $cronjob
 * @property string $value
 *
 * @property Cronjob $cronjob0
 */
class CronjobElement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */    
    public static function getDb()
    {
        $module = Module::getInstance();
        $db = $module->db;
        return Yii::$app->{$db};  
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cronjob', 'ID'),
            'cronjob' => Yii::t('cronjob', 'Cronjob'),
            'value' => Yii::t('cronjob', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjob()
    {
        return $this->hasOne(Cronjob::className(), ['id' => 'cronjob']);
    }
}
