<?php
/**
 * SiteService.php
 * atuthor: liuchg
 */
namespace  app\models\site;

use common\models\LogicModel;
use common\models\system\User;
use common\models\system\UserIdentity;

class SiteService extends LogicModel
{
    public function login(SiteForm $form){
        $user = User::findByMobile($form->phone);
        if (is_null($user)) {
            return $this->setError('账户不存在');
        }
        $isValid = $user->validatePassword($form->password);
        if (!$isValid) {
            return $this->setError('账户或密码错误不存在');
        }
        $userIdentity = new UserIdentity($user);
        \Yii::$app->user->login($userIdentity);
        $user = [
          'id' => $user->id,
          'name' => $user->name
        ];
        return $user;
    }
    public function getUser(){
        $user = \Yii::$app->user->getId();
        return $user;
    }
}