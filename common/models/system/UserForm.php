<?php
/**
 * UserForm.php
 * atuthor: liuchg
 */

namespace common\models\system;

use common\models\FormModel;
use Yii;

class UserForm extends FormModel
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(){
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
    public function attributeLabels()
    {
        return [
          'username' => '用户名',
          'password' => '密码',
          'rememberMe' => '自动登入'
        ];
    }
}