<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peran_hitung".
 *
 * @property int $id
 * @property int $peran_id
 * @property int $module_tahun_ajaran_id
 * @property int $tahun_ajaran_id
 * @property int $semester_id
 * @property int $bulan
 * @property int $tahun
 * @property int $jumlah_menit_hitung per jam(dalam satuan menit)
 * @property int $honor_menit_hitung honor imbal jasa
 * @property int $transport_hitung transport imbal jasa
 * @property int $volume_menit_pertemuan
 * @property string $keterangan
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property TahunAjaran $tahunAjaran
 * @property Module $module
 * @property Peran $peran
 */
class PeranHitung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
//    const jumlah_menit_per_sks = 50;
//    const jumlah_sks = 2;
    const volume_menit_pertemuan = 2; // 2 hour's

    public static function tableName()
    {
        return 'peran_hitung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peran_id', 'tahun_ajaran_id', 'semester_id', 'module_tahun_ajaran_id', 'bulan', 'honor_menit_hitung'], 'required'],
            [['peran_id', 'module_tahun_ajaran_id', 'tahun_ajaran_id', 'semester_id', 'tahun', 'jumlah_menit_hitung', 'honor_menit_hitung', 'transport_hitung', 'volume_menit_pertemuan', 'user_created', 'user_updated'], 'integer'],
            [['keterangan', 'bulan'], 'string'],
            [['update_time'], 'safe'],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
//            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
            [['peran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Peran::className(), 'targetAttribute' => ['peran_id' => 'id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'id']],
//            ['peran_id', 'unique', 'targetAttribute' => ['peran_id', 'module_id', 'tahun_ajaran_id'], 'comboNotUnique' => 'Peran already exist']
            ['peran_id', 'checkPeran']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'peran_id' => 'Peran',
//            'module_id' => 'Module',
            'module_tahun_ajaran_id'    =>  'Module',
            'tahun_ajaran_id' => 'Tahun Ajaran',
            'semester_id' => 'Semester',
            'bulan' => 'Bulan Tahun',
            'tahun' => 'Tahun',
//            'jumlah_sks' => 'Jumlah Sks',
            'jumlah_menit_hitung' => 'Jumlah Menit',
            'honor_menit_hitung' => 'Honor',
            'transport_hitung' => 'Transport',
//            'jumlah_menit_per_sks' => 'Menit / Sks',
            'volume_menit_pertemuan' => 'Volume / Pertemuan (Jam)',
            'keterangan' => 'Keterangan',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
    }

    // custome validation for peran_id
    public function checkPeran($attribute, $params){
        if(!empty($this->attributes)){
            
            $condition = [
                'semester_id = '.$this->semester_id,
                'module_tahun_ajaran_id = '.$this->module_tahun_ajaran_id,
                'tahun_ajaran_id = '.$this->tahun_ajaran_id,
                'bulan = '.date('m', strtotime($this->bulan)),
                'tahun = '.date('Y', strtotime($this->bulan)),
            ];
            
            if($this->isNewRecord){
                $condition = array_merge($condition, [
                    'peran_id = '.$this->peran_id,
                ]);
            } else {
                $condition = array_merge($condition, [
                    'peran_id <> '.$this->peran_id,
                    'id = '.$this->id
                ]);
            }
            
            $condition = join(" AND ", $condition);
            
            
            $unique = self::find()
                        ->where($condition)
                        ->one();
            
            if(!empty($unique)){
                $this->addError($attribute, 'Peran already exist');
            }
        }
        
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahunAjaran()
    {
        return $this->hasOne(TahunAjaran::className(), ['id' => 'tahun_ajaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleTahunAjaran()
    {
        return $this->hasOne(ModuleTahunAjaran::className(), ['id' => 'module_tahun_ajaran_id']);
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
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['id' => 'semester_id']);
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
            
            $this->jumlah_menit_hitung = 60;
            
            $this->tahun = date('Y', strtotime($this->bulan));
            $this->bulan = date('m', strtotime($this->bulan));
            
            $this->volume_menit_pertemuan = $this->volume_menit_pertemuan * 60;
            
            return true;
        };
        
        return false;
    }
}
