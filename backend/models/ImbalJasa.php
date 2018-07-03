<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imbal_jasa".
 *
 * @property int $id
 * @property string $tgl_kegiatan
 * @property int $dosen_fakultas_id
 * @property int $transaksi_id
 * @property string $nip
 * @property string $nama_dosen
 * @property string $nama_fakultas
 * @property int $dosen_fakultas_id_digantikan
 * @property string $nip_digantikan
 * @property string $nama_dosen_digantikan
 * @property string $nama_fakultas_digantikan
 * @property int $module_id
 * @property string $nama_module
 * @property int $kelas_id
 * @property string $nama_kelas
 * @property int $ruangan_id
 * @property string $nama_ruangan
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property int $peran_hitung_id
 * @property int $peran_id
 * @property string $nama_peran
 * @property int $jumlah_jam_rumus
 * @property double $transport
 * @property double $honor
 * @property string $keterangan
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property Transaksi $transaksi
 * @property Kelas $kelas
 * @property Module $module
 * @property PeranHitung $peranHitung
 * @property Peran $peran
 * @property Ruangan $ruangan
 */
class ImbalJasa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $bulan;
    public $tahun;
    
    public static function tableName()
    {
        return 'imbal_jasa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_kegiatan', 'dosen_fakultas_id', 'transaksi_id', 'nip', 'module_id', 'kelas_id', 'ruangan_id', 'jam_mulai', 'jam_selesai', 'peran_hitung_id', 'peran_id', 'jumlah_jam_rumus'], 'required'],
            [['tgl_kegiatan', 'jam_mulai', 'jam_selesai', 'update_time', 'bulan', 'tahun'], 'safe'],
            [['dosen_fakultas_id', 'transaksi_id', 'dosen_fakultas_id_digantikan', 'module_id', 'kelas_id', 'ruangan_id', 'peran_hitung_id', 'peran_id', 'jumlah_jam_rumus', 'user_created', 'user_updated'], 'integer'],
            [['transport', 'honor'], 'number'],
            [['keterangan'], 'string'],
            [['nip', 'nip_digantikan'], 'string', 'max' => 30],
            [['nama_dosen', 'nama_dosen_digantikan', 'nama_module'], 'string', 'max' => 200],
            [['nama_fakultas', 'nama_fakultas_digantikan', 'nama_kelas', 'nama_ruangan', 'nama_peran'], 'string', 'max' => 100],
            [['transaksi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaksi::className(), 'targetAttribute' => ['transaksi_id' => 'id']],
            [['kelas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['kelas_id' => 'id']],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
            [['peran_hitung_id'], 'exist', 'skipOnError' => true, 'targetClass' => PeranHitung::className(), 'targetAttribute' => ['peran_hitung_id' => 'id']],
            [['peran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Peran::className(), 'targetAttribute' => ['peran_id' => 'id']],
            [['ruangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ruangan::className(), 'targetAttribute' => ['ruangan_id' => 'id']],
            ['dosen_fakultas_id_digantikan', 'uniquedosenDigantikan']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_kegiatan' => 'Tgl Kegiatan',
            'dosen_fakultas_id' => 'Dosen Fakultas',
            'transaksi_id' => 'Transaksi',
            'nip' => 'Nip',
            'nama_dosen' => 'Nama Dosen',
            'nama_fakultas' => 'Nama Fakultas',
            'dosen_fakultas_id_digantikan' => 'Dosen Fakultas Digantikan',
            'nip_digantikan' => 'Nip Digantikan',
            'nama_dosen_digantikan' => 'Nama Dosen Digantikan',
            'nama_fakultas_digantikan' => 'Nama Fakultas Digantikan',
            'module_id' => 'Module',
            'nama_module' => 'Nama Module',
            'kelas_id' => 'Kelas',
            'nama_kelas' => 'Nama Kelas',
            'ruangan_id' => 'Ruangan',
            'nama_ruangan' => 'Nama Ruangan',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'peran_hitung_id' => 'Peran Hitung',
            'peran_id' => 'Peran',
            'nama_peran' => 'Nama Peran',
            'jumlah_jam_rumus' => 'Jumlah Jam Rumus',
            'transport' => 'Transport',
            'honor' => 'Honor',
            'keterangan' => 'Keterangan',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
    }
    
    public function uniquedosenDigantikan($attribute,$params){
        if($this->$attribute == $this->dosen_fakultas_id)
            $this->addError($attribute, 'Silahkan Tentukan Dosen Pengganti Yang Lain');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['id' => 'transaksi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'kelas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeranHitung()
    {
        return $this->hasOne(PeranHitung::className(), ['id' => 'peran_hitung_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeran()
    {
        return $this->hasOne(Peran::className(), ['id' => 'peran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuangan()
    {
        return $this->hasOne(Ruangan::className(), ['id' => 'ruangan_id']);
    }
    
    public function beforeSave($insert) {
        
        if(parent::beforeSave($insert)){
            if($insert){
                $this->user_created = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            } else {
                $this->user_updated = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            };
            
            $this->tgl_kegiatan = date('Y-m-d H:i:s', strtotime($this->tgl_kegiatan));
            $this->nama_dosen = DosenFakultas::findOne($this->dosen_fakultas_id)->dosen->nama;
            $this->nama_module = Module::findOne($this->module_id)->nama;
            $this->nama_kelas = Kelas::findOne($this->kelas_id)->nama;
            $this->nama_ruangan = Ruangan::findOne($this->ruangan_id)->nama;
            $this->nama_peran = Peran::findOne($this->peran_id)->nama;
            
            if(!empty($this->dosen_fakultas_id_digantikan)){
                $this->nama_dosen_digantikan = DosenFakultas::findOne($this->dosen_fakultas_id_digantikan)->dosen->nama;
            };
            
            
            return true;
        };
        
        return false;
    }
    
}
