<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen_fakultas".
 *
 * @property int $id
 * @property int $dosen_id
 * @property int $fakultas_id
 * @property int $tahun_ajaran_id
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property TahunAjaran $tahunAjaran
 * @property Dosen $dosen
 * @property Fakultas $fakultas
 */
class DosenFakultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen_fakultas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dosen_id', 'fakultas_id', 'tahun_ajaran_id'], 'required'],
            [['dosen_id', 'fakultas_id', 'tahun_ajaran_id', 'user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
            [['dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['dosen_id' => 'id']],
            [['fakultas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['fakultas_id' => 'id']],
            ['dosen_id', 'unique', 'targetAttribute' => ['dosen_id', 'fakultas_id', 'tahun_ajaran_id'], 'comboNotUnique' => 'Dosen already exist']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dosen_id' => 'Dosen',
            'fakultas_id' => 'Fakultas',
            'tahun_ajaran_id' => 'Tahun Ajaran',
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
    public function getFakultas()
    {
        return $this->hasOne(Fakultas::className(), ['id' => 'fakultas_id']);
    }
}
