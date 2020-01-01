<?php
/**
 * SiteService.php
 * atuthor: liuchg
 */
namespace  app\models\site;

use common\models\LogicModel;

class SiteService extends LogicModel
{
    public function login(){

    }
    public function getUser(){
        $user = \Yii::$app->user->getId();
        return $user;
    }
}