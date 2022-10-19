<?php


namespace app\models\site;


use common\models\FormModel;

class SiteForm extends FormModel
{
    public $phone;
    public $password;
    public $username;
    public $rememberMe;
    public function rules()
    {
        return [
            [['phone', 'password'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
          'phone' => '手机号码',
          'password' => '密码'
        ];
    }
}
