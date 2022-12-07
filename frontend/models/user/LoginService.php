<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\user;


use common\components\JWT;
use common\models\account\AccountUser;
use common\models\LogicModel;
use yii\base\Exception;
use yii\base\Security;

class LoginService extends LogicModel
{
    public function login(LoginForm $form){
        $account = AccountUser::findByUserName($form->username);
        $security = new Security();

        if (is_null($account) || !$security->validatePassword($form->password, $account->password)) {
            return $this->setError('账号密码不正确');
        }
        /**
         * @var $jwt JWT
         */
        $jwt = \Yii::$app->get('jwt');
        try {
            $load = $jwt->encode($account->id);
        } catch (Exception $e) {
            return $this->setError($e->getMessage());
        }
        return $load;
    }

    public function register(RegisterForm $form )
    {
        if (AccountUser::existByUsername($form->username)) {
            return $this->setError('用户名已经存在');
        }

        $account = new AccountUser();
        $account->username = $form->username;
        $account->password = \Yii::$app->security->generatePasswordHash($form->password);
        $account->create_ip_at = \Yii::$app->request->getUserIP();
        if (!$account->save()) {
            return $this->addErrors($account->getErrors());
        }

        return true;
    }
}
