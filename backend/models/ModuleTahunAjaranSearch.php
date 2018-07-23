<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModuleTahunAjaran;

/**
 * ModuleTahunAjaranSearch represents the model behind the search form of `app\models\ModuleTahunAjaran`.
 */
class ModuleTahunAjaranSearch extends ModuleTahunAjaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'module_id', 'tahun_ajaran_id', 'jumlah_sks', 'jumlah_menit_per_sks', 'user_created', 'user_updated'], 'integer'],
            [['nama', 'periode', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ModuleTahunAjaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'module_id' => $this->module_id,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
            'jumlah_sks' => $this->jumlah_sks,
            'jumlah_menit_per_sks' => $this->jumlah_menit_per_sks,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'periode', $this->periode]);

        return $dataProvider;
    }
}
