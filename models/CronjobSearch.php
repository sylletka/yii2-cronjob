<?php

namespace sylletka\cronjob\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use sylletka\cronjob\models\Cronjob;

/**
 * CronjobSearch represents the model behind the search form about `sylletka\cronjob\models\Cronjob`.
 */
class CronjobSearch extends Cronjob
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['cron_command', 'params'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cronjob::find();
        $query->with('cronjobMinutes');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
/*            'minute' => $this->minute,
            'hour' => $this->hour,
            'day' => $this->day,
            'month' => $this->month,
            'day_of_week' => $this->day_of_week,*/
        ]);

        $query->andFilterWhere(['like', 'cron_command', $this->cron_command])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
