<?php

namespace app\models;

use Yii;
use app\models\Dosen;

/**
 * This is the model class for table "personijd".
 *
 * @property int $id
 * @property int $dosen_id
 * @property int $jabatan_id
 * @property int $tahun_ajaran_id
 * @property string $nip
 * @property string $nama
 * @property int $status 1: aktif, 0: not aktif
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property TahunAjaran $tahunAjaran
 * @property Dosen $dosen
 * @property Jabatan $jabatan
 */
class Personijd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
    
    const JABATAN_SDM = 2;
    
    public static function tableName()
    {
        return 'personijd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dosen_id', 'jabatan_id', 'status'], 'required'],
            [['dosen_id', 'jabatan_id', 'tahun_ajaran_id', 'status', 'user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['nip'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 200],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
            [['dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['dosen_id' => 'id']],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dosen_id' => 'Nama',
            'jabatan_id' => 'Jabatan',
            'tahun_ajaran_id' => 'Tahun Ajaran',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'status' => 'Status',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
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
    public function getDosen()
    {
        return $this->hasOne(Dosen::className(), ['id' => 'dosen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(Jabatan::className(), ['id' => 'jabatan_id']);
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
            
            $dosen = Dosen::findOne($this->dosen_id);
            $this->nip = $dosen->nip;
            $this->nama = $dosen->nama;
            
            return true;
        };
        
        return false;
    }
}
