<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TahunAjaran;

/**
 * TahunAjaranSearch represents the model behind the search form of `app\models\TahunAjaran`.
 */
class TahunAjaranSearch extends TahunAjaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_created', 'user_updated'], 'integer'],
            [['periode_awal', 'periode_akhir', 'periode', 'update_time'], 'safe'],
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
        $query = TahunAjaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'periode_awal' => $this->periode_awal,
            'periode_akhir' => $this->periode_akhir,
            'status' => $this->status,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode]);

        return $dataProvider;
    }
}
