<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

/**
 * TransaksiSearch represents the model behind the search form of `app\models\Transaksi`.
 */
class TransaksiSearch extends Transaksi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tahun_ajaran_id', 'user_created', 'user_updated'], 'integer'],
            [['no_transaksi', 'tgl_transaksi', 'bulan_tahun', 'keterangan', 'update_time'], 'safe'],
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
        $query = Transaksi::find();

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
            'tgl_transaksi' => $this->tgl_transaksi,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
//            'bulan_tahun' => $this->bulan_tahun,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'no_transaksi', $this->no_transaksi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['=', 'MONTH(bulan_tahun)', $this->bulan_tahun]);
        
        return $dataProvider;
    }
}
