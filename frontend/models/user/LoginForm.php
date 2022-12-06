<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\user;


use common\models\FormModel;

class LoginForm extends FormModel
{
    public $username;
    public $password;

    public function rules()
    {
        return [
          [['username', 'password'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码'
        ];
    }
}
