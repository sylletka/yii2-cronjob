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
            'id' => Yii::t('gestione', 'ID'),
            'cronjob' => Yii::t('gestione', 'Cronjob'),
            'value' => Yii::t('gestione', 'Value'),
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
