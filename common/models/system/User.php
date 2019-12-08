<?php
/**
 * User.php
 * atuthor: liuchg
 */
namespace common\models\system;

use common\models\ActiveRecord;
use Yii;
/**
 * This is the model class for table "user".Class User
 * @property $id  integer 用户ID
 * @property $username string 用户名
 * @property $password_hash string 用户密码
 * @property $name string 用户名字
 * @property $mobi string 用户手机
 * @property $email string 登入邮箱
 * @property $status integer 状态
 * @property $timeout integer 登入超出时间
 * @property $note string 备注
 * @property $creat_time string 注册时间
 * @property $update_time string 更新时间
 *
 */
class User extends ActiveRecord
{
    const ADMIN_ID = 101;
    /**
     * @var integer 状态-有效
     */
    const STATUS_100 = 100;
    /**
     * @var integer 状态-未激活
     */
    const STATUS_200 = 200;
    /**
     * @var integer 状态-有效
     */
    const STATUS_300 = 300;
    /**
     * @var integer 状态-冻结
     */
    const STATUS_400 = 400;
    /**
     * @var integer 状态-不可登入
     */
    const STATUS_500 = 500;
    /**
     * @var integer 状态-注销
     */
    const STATUS_505 = 505;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password_hash', 'email', 'name', 'status'], 'required'],
            [['status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['password_hash'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 90],
            [['note'], 'string', 'max' => 255],
            [['username'], 'unique']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'username' => '用户名',
            'password_hash' => '登录密码',
            'name' => '姓名',
            'mobi' => '手机号码',
            'status' => '状态',
            'timeout' => '登录超时时间',
            'note' => '备注',
            'create_time' => '添加时间',
            'update_time' => '更新时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            $this->timestampBehavior(),
        ];
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username,'status'=>static::STATUS_200]);
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}