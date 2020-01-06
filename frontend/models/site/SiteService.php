<?php
/**
 * SiteService.php
 * atuthor: liuchg
 */
namespace  app\models\site;

use common\models\Error;
use common\models\LogicModel;
use common\models\system\User;
use common\models\system\UserIdentity;
use common\models\system\UserModel;

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

    /**
     * 注册
     * @param RegisterForm $form
     * @return bool
     * @throws \yii\base\Exception
     */
    public function create(RegisterForm $form){
        $attributions['mobile'] = $form->phone;
        $attributions['password_hash'] = $form->password;
        $res = UserModel::create($attributions, '');
        if (Error::isError($res)) {
            return $this->setError($res->getError());
        }

        return true;
    }
    public function getUser(){
        $user = \Yii::$app->user->getId();
        return $user;
    }
}