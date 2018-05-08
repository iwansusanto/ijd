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
}
