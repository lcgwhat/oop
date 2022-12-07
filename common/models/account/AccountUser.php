<?php

namespace common\models\account;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "account_user".
 *
 * @property int $id 账号id
 * @property string $email 邮箱
 * @property string $username 用户名
 * @property string $password 密码
 * @property int $create_at 创建时间
 * @property string $create_ip_at 创建ip
 */
class AccountUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_user';
    }

    public static function findById(int $id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_at'], 'safe'],
            [['email', 'username'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 60],
            [['create_ip_at'], 'string', 'max' => 12],
        ];
    }
    public function behaviors()
    {
        return [
           [
               'class' => TimestampBehavior::class,
               'createdAtAttribute' => 'create_at',
               'updatedAtAttribute' => null
           ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '账号id'),
            'email' => Yii::t('app', '邮箱'),
            'username' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'create_at' => Yii::t('app', '创建时间'),
            'create_ip_at' => Yii::t('app', '创建ip'),
        ];
    }

    /**
     * @param $username
     * @return AccountUser|null
     */
    public static function findByUserName($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function existByUsername($username)
    {
        return self::find()->andWhere(['username' => $username])->exists();
    }
}
