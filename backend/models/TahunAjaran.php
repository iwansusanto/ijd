<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property int $id
 * @property string $periode_awal
 * @property string $periode_akhir
 * @property string $periode
 * @property int $status
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
    
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['periode_awal', 'periode_akhir'], 'required'],
            [['periode_awal', 'periode_akhir', 'update_time', 'id'], 'safe'],
            [['status', 'user_created', 'user_updated'], 'integer'],
            [['periode'], 'string', 'max' => 50],
            [['periode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'periode_awal' => 'Periode Awal',
            'periode_akhir' => 'Periode Akhir',
            'periode' => 'Periode',
            'status' => 'Status',
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
            
            if($this->status == self::STATUS_ACTIVE){
                self::updateAll(['status' => self::STATUS_NOT_ACTIVE], 'status = '.self::STATUS_ACTIVE);
            };
            
            return true;
        };
        
        return false;
    }
}
