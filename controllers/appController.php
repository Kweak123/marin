<?php

namespace app\controllers;

class appController extends \yii\web\Controller
{
    public function action()
    {
        $session = \Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
    }

}
