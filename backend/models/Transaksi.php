<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property string $no_transaksi Ym/IJD/xxx
 * @property string $tgl_transaksi
 * @property string $bulan_tahun
 * @property string $keterangan
 * @property int $user_created
 * @property int $user_updated
 * @property string $update_time
 *
 * @property ImbalJasa[] $imbalJasas
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulan_tahun'], 'required'],
            [['tgl_transaksi', 'bulan_tahun', 'update_time'], 'safe'],
            [['keterangan'], 'string'],
            [['user_created', 'user_updated'], 'integer'],
            [['no_transaksi'], 'string', 'max' => 15],
            [['no_transaksi'], 'unique'],
//            [['bulan_tahun'], 'unique'],
            ['bulan_tahun', 'checkBulantahun']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_transaksi' => 'No Transaksi',
            'tgl_transaksi' => 'Tgl Transaksi',
            'bulan_tahun' => 'Bulan Tahun',
            'keterangan' => 'Keterangan',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'update_time' => 'Update Time',
        ];
    }
    
    // custome validation for peran_id
    public function checkBulantahun($attribute, $params){
        
        if(!empty($this->attributes)){
            
            $condition = [];
            
            if($this->isNewRecord){
                $condition = [
                    'MONTH(bulan_tahun) = '.date("m", strtotime($this->bulan_tahun)),
                    'YEAR(bulan_tahun) = '.date("Y", strtotime($this->bulan_tahun))
                ];
            } else {
                $condition = [
                    'MONTH(bulan_tahun) <> '.date("m", strtotime($this->bulan_tahun)),
                    'YEAR(bulan_tahun) <> '.date("Y", strtotime($this->bulan_tahun)),
                    'id = '.$this->id
                ];
            }
            $condition = join(" AND ", $condition);
            $unique = self::find()
                        ->where($condition)
                        ->one();
            
            if(!empty($unique)){
                $this->addError($attribute, 'Bulan Tahun already exist');
            }
        }
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImbalJasas()
    {
        return $this->hasMany(ImbalJasa::className(), ['transaksi_id' => 'id']);
    }
    
    public function beforeSave($insert) {
        
        if(parent::beforeSave($insert)){
            if($insert){
                $this->tgl_transaksi = date('Y-m-d H:i:s');     
                $this->user_created = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            } else {
                $this->user_updated = Yii::$app->user->id;
                $this->update_time = date('Y-m-d H:i:s');
            };
            
            $this->bulan_tahun = date('Y-m-d', strtotime($this->bulan_tahun));   
            return true;
        };
        
        return false;
    }
}
