<?php

namespace sylletka\cronjob\models;

use Yii;
use sylletka\cronjob\Module;

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
            [['cron_command', 'params'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cronjob', 'ID'),
            'cron_command' => Yii::t('cronjob', 'Cron Command'),
            'params' => Yii::t('cronjob', 'Params'),
        ];
    }

    /**
	 * @return \yii\db\ActiveQuery
	 */
    public function getCronjobDays()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id'])->alias('days')->where(['days.key' => 'day']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjobDayOfWeeks()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id'])->alias('day_of_weeks')->where(['day_of_weeks.key' => 'day_of_week']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjobHours()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id'])->alias('hours')->where(['hours.key' => 'hour']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjobMinutes()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id'])->alias('minutes')->where(['minutes.key' => 'minute']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjobMonths()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id'])->alias('months')->where(['months.key' => 'month']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCronjobElements()
    {
       return $this->hasMany(CronjobElement::className(), ['cronjob' => 'id']);
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

    public function afterSave( $insert, $changedAttributes )
    {
        parent::afterSave( $insert, $changedAttributes );
        CronjobElement::deleteAll('cronjob = ' . $this->id);
    }

    public function getCronjobString()
    {
        $attributes = [
            'cronjobMinutes',
            'cronjobHours',
            'cronjobDays',
            'cronjobDayOfWeeks',
            'cronjobMonths',
        ];
        $out = [];
        foreach ( $attributes as $attribute ){
            $out[] = $this->asText($attribute);
        }
        return implode(" ", $out);
    }

    public function getCrontabString()
    {
        return $this->cron_command . " " . $this->cronjobString;
    }

    public function getCronjobDayOfWeeksAsText()
    {
        if (count($this->cronjobDayOfWeeks > 0)){
            $out = [];
            $list = array_merge(['*'=>'*'],$this->listDaysOfWeek());
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
            return implode(",", $out);
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

    public function getRelationMap(){
        return [
            'minute' => 'cronjobMinutes',
            'hour' => 'cronjobHours',
            'day' => 'cronjobDays',
            'day_of_week' => 'cronjobDayOfWeeks',
            'month' => 'cronjobMonths'
        ];
    }
}
