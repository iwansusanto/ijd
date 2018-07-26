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
    
    public function status($id = null){
        $status = [
            '0' =>  'Not Active',
            '1' =>  'Active',
        ];
        
        if($id !== null)
            return $status[$id];
        
        return $status;
    }
    
    public function tanggalIndonesia($date = null, $type = false){
        $date = date('Y-m-d',strtotime($date));
        if($date == '0000-00-00')
            return 'Tanggal Kosong';
        
        $tgl = substr($date, 8, 2);
        $bln = substr($date, 5, 2);
        $thn = substr($date, 0, 4);

        switch ($bln) {
            case 1 : {
                    $bln = 'Januari';
                }break;
            case 2 : {
                    $bln = 'Februari';
                }break;
            case 3 : {
                    $bln = 'Maret';
                }break;
            case 4 : {
                    $bln = 'April';
                }break;
            case 5 : {
                    $bln = 'Mei';
                }break;
            case 6 : {
                    $bln = "Juni";
                }break;
            case 7 : {
                    $bln = 'Juli';
                }break;
            case 8 : {
                    $bln = 'Agustus';
                }break;
            case 9 : {
                    $bln = 'September';
                }break;
            case 10 : {
                    $bln = 'Oktober';
                }break;
            case 11 : {
                    $bln = 'November';
                }break;
            case 12 : {
                    $bln = 'Desember';
                }break;
            default: {
                    $bln = 'UnKnown';
                }break;
        }

        $hari = date('N', strtotime($date));
        switch ($hari) {
            case 0 : {
                    $hari = 'Minggu';
                }break;
            case 1 : {
                    $hari = 'Senin';
                }break;
            case 2 : {
                    $hari = 'Selasa';
                }break;
            case 3 : {
                    $hari = 'Rabu';
                }break;
            case 4 : {
                    $hari = 'Kamis';
                }break;
            case 5 : {
                    $hari = "Jum'at";
                }break;
            case 6 : {
                    $hari = 'Sabtu';
                }break;
            default: {
                    $hari = 'UnKnown';
                }break;
        }
        
        $tanggalIndonesia = $tgl . " " . $bln . " " . $thn;
        if(!$type){
            $tanggalIndonesia = $hari.", ".$tgl . " " . $bln . " " . $thn;
        };
        
        return $tanggalIndonesia;
    }
}
