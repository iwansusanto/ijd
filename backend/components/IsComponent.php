<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;

use yii\base\Component;
use app\models\TahunAjaran;
/**
 * Description of IsComponent
 *
 * @author HP Pavilion
 */
class IsComponent extends Component {
    //put your code here
    
    public function tahunajaran(){
        $tahunAjaran = TahunAjaran::find()->where(['status' => TahunAjaran::STATUS_ACTIVE])->one();
        
        if(!empty($tahunAjaran))
            return $tahunAjaran;
        
        
    }
    
    public function bulan($index = null){
        
        $bulan = [
                1   =>  'Jan',
                2   =>  'Feb',
                3   =>  'Mar',
                4   =>  'April',
                5   =>  'May',
                6   =>  'Jun',
                7   =>  'Jul',
                8   =>  'August',
                9   =>  'Sept',
                10   =>  'Oct',
                11   =>  'Nov',
                12   =>  'Dec',
            ];
        
        if(!is_null($index)){
            $bulan = $bulan[$index];
        }
        
        
        return $bulan;
        
    }
    
    public function bulanhitung($date = null){
        $session = \Yii::$app->session;
        
        // session from transaksi/imbaljasa
        if ($session->has('bulan_tahun') && $date == null)
            return date('m', strtotime($session->get('bulan_tahun')));
        
        return date('m', strtotime($date));
    }
    
    public function tahunhitung($date = null){
        $session = \Yii::$app->session;
        
        // session from transaksi/imbaljasa
        if ($session->has('bulan_tahun') && $date == null)
            return date('Y', strtotime($session->get('bulan_tahun')));
        
        return date('Y', strtotime($date));
    }
    
    public function urut_100(){
        $no = [];
        for($x = 1; $x <= 100; $x++):
            $no[$x] = $x;
        endfor;
        
        return $no;
    }
}
