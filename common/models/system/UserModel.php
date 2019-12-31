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