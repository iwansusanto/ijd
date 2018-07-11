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
 */
class DosenFakultas_old extends \yii\db\ActiveRecord
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
            [['dosen_id', 'fakultas_id'], 'required'],
            [['dosen_id', 'fakultas_id', 'tahun_ajaran_id', 'user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
//            [['dosen_id'], 'unique'],
//            [['fakultas_id'], 'unique'],
//            [['tahun_ajaran_id'], 'unique'],
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
    
    public function beforeSave($insert) {
        
        if(parent::beforeSave($insert)){
            if($insert){
                $this->user_created = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            } else {
                $this->user_updated = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            };
            return true;
        };
        
        return false;
    }
}
