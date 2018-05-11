<?php

namespace app\components;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formatter
 *
 * @author HP Pavilion
 */
use yii\i18n\Formatter;

class isFormatter extends Formatter {
    //put your code here
    public function asRoundedCurrency($value, $currency = null)
    {
        return  $currency. ' ' . str_replace(',', '.', $this->asInteger($value));
    }
}
