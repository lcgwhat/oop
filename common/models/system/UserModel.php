<?php
/**
 * UserModel.php
 * atuthor: liuchg
 */

namespace common\models\system;

use common\models\Error;
use common\models\LogicModel;

class UserModel extends LogicModel
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     * @param $attrib
     * mobile
     * password_hash
     * @param $note
     * @return bool|Error
     * @throws \yii\base\Exception
     */
    public static function create($attrib, $note){
        $exist = User::existByMobile($attrib['mobile']);
        if ($exist) {
            return new Error('改手机号码已被占用');
        }
        $model = new User();
        $model->mobi = $attrib['mobile'];
        $model->name = uniqid('luxi—');
        $model->username = uniqid('user');
        $model->password_hash = \Yii::$app->security->generatePasswordHash($attrib['password_hash']);
        $model->email = '22';
        $model->note = $note;
        $model->status = User::STATUS_200;
        if (!$model->save()) {
            return new Error($model->getErrors());
        }

        return true;
    }
    /**
     * @return User 返回用户对象
     */
    public function getData() {
        return $this->model;
    }

    public static function getById($id) {
        $model = User::findById($id);
        if ($model === null) {
            return null;
        }

        return new self($model);
    }

    public static function getByUsername($username) {
        $model = User::findByUsername($username);
        if ($model === null) {
            return null;
        }

        return new self($model);
    }

    public static function checkUserName($username) {
        $username = strtolower($username);
        if (User::existsByUserName($username)) {
            return new Error('用户名已经存在。');
        }

        return true;
    }
}