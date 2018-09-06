<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $id
 * @property string $nama
 * @property string $keterangan
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property DosenFakultas[] $dosenFakultas
 * @property ModuleKelas[] $moduleKelas
 * @property ModuleTahunAjaran[] $moduleTahunAjarans
 * @property PeranHitung[] $peranHitungs
 * @property Transaksi[] $transaksis
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'user_created', 'update_time'], 'required'],
            [['keterangan'], 'string'],
            [['user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['nama'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosenFakultas()
    {
        return $this->hasMany(DosenFakultas::className(), ['semester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleKelas()
    {
        return $this->hasMany(ModuleKelas::className(), ['semester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleTahunAjarans()
    {
        return $this->hasMany(ModuleTahunAjaran::className(), ['semester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeranHitungs()
    {
        return $this->hasMany(PeranHitung::className(), ['semester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['semester_id' => 'id']);
    }
}
