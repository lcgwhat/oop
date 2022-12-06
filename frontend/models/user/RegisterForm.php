<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\user;


class RegisterForm extends \common\models\FormModel
{
    public $username;
    public $password;

    public function rules()
    {
        return [
          [['username', 'password'], 'required']  ,
            [['password'], 'string', 'min'=>6]
        ];
    }

}
