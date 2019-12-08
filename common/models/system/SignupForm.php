<?php
/**
 * Signup.php
 * atuthor: liuchg
 */

namespace common\models\system;


use common\models\FormModel;

class SignupForm extends FormModel
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\system\User', 'message' => '用户名已被占用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\system\User', 'message' => '邮箱已被占'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱'
        ];
    }

    /**
     * @return bool|null
     * @throws \yii\base\Exception
     */
    public function signup(){
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        if (!$user->save()) {
            return false;
        }
        echo '成功';die;
        return $user->save();
    }
}