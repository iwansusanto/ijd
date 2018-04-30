<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fakultas".
 *
 * @property int $id
 * @property string $nama
 * @property string $keterangan
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakultas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['keterangan'], 'string'],
            [['user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['nama'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
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
