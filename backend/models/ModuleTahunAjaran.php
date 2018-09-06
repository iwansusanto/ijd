<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "module_tahun_ajaran".
 *
 * @property int $id
 * @property int $module_id
 * @property string $nama
 * @property int $tahun_ajaran_id
 * @property int $semester_id
 * @property string $periode
 * @property int $jumlah_sks
 * @property int $jumlah_menit_per_sks
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property TahunAjaran $tahunAjaran
 * @property Module $module
 */
class ModuleTahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const jumlah_menit_per_sks = 50;
    const jumlah_sks = 2;
    
    public static function tableName()
    {
        return 'module_tahun_ajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['module_id', 'tahun_ajaran_id', 'semester_id', 'jumlah_sks', 'jumlah_menit_per_sks'], 'required'],
            [['module_id', 'tahun_ajaran_id', 'semester_id', 'jumlah_sks', 'jumlah_menit_per_sks', 'user_created', 'user_updated'], 'integer'],
            [['update_time', 'periode', 'nama'], 'safe'],
            [['nama'], 'string', 'max' => 200],
            [['periode'], 'string', 'max' => 50],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
//            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
            ['module_id', 'unique', 'targetAttribute' => ['module_id', 'tahun_ajaran_id', 'semester_id'], 'comboNotUnique' => 'Module already exist']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_id' => 'Module',
            'nama' => 'Nama Module',
            'tahun_ajaran_id' => 'Tahun Ajaran',
            'semester_id'   =>  'Semester',
            'periode' => 'Tahun Ajaran',
            'jumlah_sks' => 'Jumlah Sks',
            'jumlah_menit_per_sks' => 'Jumlah Menit Per Sks',
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
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
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
            
            $this->periode = TahunAjaran::findOne($this->tahun_ajaran_id)->periode;
            $this->nama = Module::findOne($this->module_id)->nama;
            
            return true;
        };
        
        return false;
    }
}
