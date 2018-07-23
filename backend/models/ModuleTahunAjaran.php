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
            [['module_id', 'nama', 'tahun_ajaran_id', 'periode', 'jumlah_sks'], 'required'],
            [['module_id', 'tahun_ajaran_id', 'jumlah_sks', 'jumlah_menit_per_sks', 'user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['nama'], 'string', 'max' => 200],
            [['periode'], 'string', 'max' => 50],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
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
}
