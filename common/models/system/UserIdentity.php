<?php
/**
 * UserIdentity.php
 * atuthor: liuchg
 */

namespace common\models\system;


use yii\base\NotSupportedException;

class UserIdentity extends \common\models\UserIdentify
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param int|string $id
     * @return UserIdentity|null|\yii\web\IdentityInterface
     */
    public static function findIdentity($id)
    {
        $user = User::findById($id);
        if (!$user) {
            return null;
        }
        return new self($user);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return null|void|\yii\web\IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public function getId()
    {
        return $this->user->id;
    }


    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }


    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * @return integer 返回当前用户类型
     */
    public function getType()
    {
        return self::TYPE_SYSTEM;
    }

    /**
     * @return string 返回当前用户名称
     */
    public function getName()
    {
        return $this->user->name;
    }


}