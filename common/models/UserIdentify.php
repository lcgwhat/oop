<?php
/**
 * userIdentify.php
 * atuthor: liuchg
 */

namespace common\models;


use yii\web\IdentityInterface;

abstract class UserIdentify implements IdentityInterface
{
    /**
     * @var integer 用户类型-系统用户
     */
    const TYPE_SYSTEM = 1000;
    /**
     * @var integer 用户类型-仓库用户
     */
    const TYPE_STOREHOUSE = 2000;

    const TYPE_USER = 3000;

    const TYPE_ADMIN = 4000;
    /**
     * @return integer 返回当前用户类型
     */
    public abstract function getType();
    /**
     * @return string 返回当前用户名称
     */
    public abstract function getName();

    /**
     * @return integer 返回当前系统用户ID，如果非系统用户，则统一返回100
     */
    public function getSysUserId() {
        $type = $this->getType();
        return ($type == self::TYPE_SYSTEM)? $this->getId() : 100;
    }

    /**
     * @return boolean 返回当前用户是否为系统用户
     */
    public function isSysUser() {
        $type = $this->getType();
        return ($type == self::TYPE_SYSTEM);
    }

    /**
     * 返回格式化后的用户名称
     * @param integer $type 用户类型
     * @param integer $id 用户ID
     * @param string $name 用户名称
     */
    public static function getFullName($type, $id, $name) {
        $names = [
            self::TYPE_USER => '普通用户',
            self::TYPE_ADMIN => '系统用户',

        ];

        return "[{$names[$type]}]$name";
    }

    public static function setParam($name, $value) {
        \Yii::$app->getSession()->set($name, $value);
    }

    public static function getParam($name, $defaultValue=null) {
        return \Yii::$app->getSession()->get($name, $defaultValue);
    }
}