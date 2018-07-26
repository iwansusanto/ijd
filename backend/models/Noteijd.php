<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noteijd".
 *
 * @property int $id
 * @property string $title
 * @property int $tahun_ajaran_id
 * @property int $no_urut
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property TahunAjaran $tahunAjaran
 */
class Noteijd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noteijd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'no_urut'], 'required'],
            [['tahun_ajaran_id', 'no_urut', 'user_created', 'user_updated'], 'integer'],
            [['update_time'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['tahun_ajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TahunAjaran::className(), 'targetAttribute' => ['tahun_ajaran_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'tahun_ajaran_id' => 'Tahun Ajaran ID',
            'no_urut' => 'No Urut',
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
