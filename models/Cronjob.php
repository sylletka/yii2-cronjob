<?php

namespace sylletka\cronjob\models;

use Yii;

/**
 * This is the model class for table "cronjob".
 *
 * @property integer $id
 * @property string $cron_command
 * @property string $params
 *
 * @property CronjobDay[] $cronjobDays 
 * @property CronjobDayOfWeek[] $cronjobDayOfWeeks 
 * @property CronjobHour[] $cronjobHours 
 * @property CronjobMinute[] $cronjobMinutes 
 * @property CronjobMonth[] $cronjobMonths 
 */
class Cronjob extends \yii\db\ActiveRecord
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
    public static function tableName()
    {
        return 'cronjob';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cron_command'], 'required'],
            [['cron_command', 'params'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('gestione', 'ID'),
            'cron_command' => Yii::t('gestione', 'Cron Command'),
            'params' => Yii::t('gestione', 'Params'),
        ];
    }

    /**
	 * @return \yii\db\ActiveQuery
	 */
    public function getCronjobDays()
    {
       return $this->hasMany(CronjobDay::className(), ['cronjob' => 'id']);
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCronjobDayOfWeeks()
    {
       return $this->hasMany(CronjobDayOfWeek::className(), ['cronjob' => 'id']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCronjobHours()
    {
       return $this->hasMany(CronjobHour::className(), ['cronjob' => 'id']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCronjobMinutes()
    {
       return $this->hasMany(CronjobMinute::className(), ['cronjob' => 'id']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCronjobMonths()
    {
       return $this->hasMany(CronjobMonth::className(), ['cronjob' => 'id']);
    }
    
    public static function find()
	{
       return new CronjobQuery(get_called_class());
	}

    public function getCronjobMinutesAsText()
    {
        return $this->asText('cronjobMinutes');
    }

    public function getCronjobHoursAsText()
    {
        return $this->asText('cronjobHours');
    }

    public function getCronjobDaysAsText()
    {
        return $this->asText('cronjobDays');
    }

    public function getCronjobDayOfWeeksAsText()
    {
        if (count($this->cronjobDayOfWeeks > 0)){
            $out = [];
            $list = $this->listDaysOfWeek();
            foreach ($this->cronjobDayOfWeeks as $model){
                if ($model->value != "0") {
                    $out[] = $list[$model->value];
                } else {
                    $out[] = "*";
                }
            }
            return implode(", ", $out);
        } else {
            return "*";
        } 
    }

    public function getCronjobMonthsAsText()
    {
        return $this->asText('cronjobMonths');
    }

    private function asText($attribute)
    {
        if (count($this->$attribute > 0)){
            $out = [];
            foreach ($this->$attribute as $model){
                $out[] = $model->value;
            }
            return implode(", ", $out);
        } else {
            return "*";
        } 
    }

    public function listDaysOfWeek(){
        $days_of_week = [];
        foreach (range(1,7) as $day){
            $days_of_week[$day] = date('D', strtotime("Sunday +{$day} days"));
        }
        return $days_of_week;
    }
}
