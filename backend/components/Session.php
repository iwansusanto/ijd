<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;


use Yii;
/**
 * Description of Session
 *
 * @author HP Pavilion
 */
class Session extends \yii\web\Session {

    public function getAllFlashesNormalized() {
        $flashes = [];
        foreach (Yii::$app->session->getAllFlashes() as $key => $flash) {
            if (is_array($flash))
                foreach ($flash AS $message)
                    $flashes[] = ['key' => $key, 'message' => $message];
            else
                $flashes[] = ['key' => $key, 'message' => $flash];
        }

        return $flashes;
    }
}