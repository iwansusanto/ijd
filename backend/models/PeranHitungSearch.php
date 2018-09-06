<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PeranHitung;

/**
 * PeranHitungSearch represents the model behind the search form of `app\models\PeranHitung`.
 */
class PeranHitungSearch extends PeranHitung
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'peran_id', 'module_tahun_ajaran_id', 'tahun_ajaran_id', 'semester_id', 'bulan', 'tahun', 'jumlah_menit_hitung', 'honor_menit_hitung', 'transport_hitung', 'volume_menit_pertemuan', 'user_created', 'user_updated'], 'integer'],
            [['keterangan', 'update_time'], 'safe'],
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
        $query = PeranHitung::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'module_tahun_ajaran_id'  =>  SORT_ASC,
                    'id' => SORT_DESC]]
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
            'peran_id' => $this->peran_id,
//            'module_id' => $this->module_id,
            'module_tahun_ajaran_id' => $this->module_tahun_ajaran_id,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
            'semester_id' => $this->semester_id,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
//            'jumlah_sks' => $this->jumlah_sks,
            'jumlah_menit_hitung' => $this->jumlah_menit_hitung,
            'honor_menit_hitung' => $this->honor_menit_hitung,
            'transport_hitung' => $this->transport_hitung,
//            'jumlah_menit_per_sks' => $this->jumlah_menit_per_sks,
            'volume_menit_pertemuan' => $this->volume_menit_pertemuan,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
