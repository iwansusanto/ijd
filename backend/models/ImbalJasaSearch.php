<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ImbalJasa;

/**
 * ImbalJasaSearch represents the model behind the search form of `app\models\ImbalJasa`.
 */
class ImbalJasaSearch extends ImbalJasa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dosen_fakultas_id', 'nip', 'dosen_fakultas_id_digantikan', 'nip_digantikan', 'module_tahun_ajaran_id', 'kelas_id', 'ruangan_id', 'peran_hitung_id', 'peran_id', 'user_created', 'user_updated'], 'integer'],
            [['tgl_kegiatan', 'nama_dosen', 'nama_fakultas', 'nama_dosen_digantikan', 'nama_fakultas_digantikan', 'nama_kelas', 'nama_ruangan', 'jam_mulai', 'jam_selesai', 'nama_peran', 'keterangan', 'update_time'], 'safe'],
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
        $query = ImbalJasa::find();

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
            'tgl_kegiatan' => $this->tgl_kegiatan,
            'dosen_fakultas_id' => $this->dosen_fakultas_id,
            'nip' => $this->nip,
            'dosen_fakultas_id_digantikan' => $this->dosen_fakultas_id_digantikan,
            'nip_digantikan' => $this->nip_digantikan,
            'module_tahun_ajaran_id' => $this->module_tahun_ajaran_id,
            'kelas_id' => $this->kelas_id,
            'ruangan_id' => $this->ruangan_id,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'peran_hitung_id' => $this->peran_hitung_id,
            'peran_id' => $this->peran_id,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'nama_dosen', $this->nama_dosen])
            ->andFilterWhere(['like', 'nama_fakultas', $this->nama_fakultas])
            ->andFilterWhere(['like', 'nama_dosen_digantikan', $this->nama_dosen_digantikan])
            ->andFilterWhere(['like', 'nama_fakultas_digantikan', $this->nama_fakultas_digantikan])
//            ->andFilterWhere(['like', 'nama_module', $this->nama_module])
            ->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas])
            ->andFilterWhere(['like', 'nama_ruangan', $this->nama_ruangan])
            ->andFilterWhere(['like', 'nama_peran', $this->nama_peran])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
