<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\components;
/**
 * Description of User
 *
 * @author HP Pavilion
 */
use Yii;

class User extends \yii\web\User {
    //put your code here
    
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function getName()
    {
        return \Yii::$app->user->identity->name;
    }
}
