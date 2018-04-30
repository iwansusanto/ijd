<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id
 * @property string $nip
 * @property string $nama
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'nama'], 'required'],
            ['nip', 'unique'],
            [['user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['nip'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
    }
    
    public function beforeSave($insert) {
        
        if(parent::beforeSave($insert)){
            $this->user_created = Yii::$app->user->id;
            $this->update_time = date('Y-m-d H:i:s');
            return true;
        } else {
            $this->user_updated = Yii::$app->user->id;
            $this->update_time = date('Y-m-d H:i:s');
            return true;
        };
        
        
    }
}
