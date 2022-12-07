<?php
/**
 * @author: liuchg
 *
 */
namespace common\components;

use common\models\Error;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\ValidationData;
use Yii;
use yii\base\Component;

Class JWT extends Component
{
    private $_payloadKey = 'user';
    private $expire = 3600 * 72;
    public $jwt_secret;

    /**
     * @param $customPayload
     * @return string
     * @throws \yii\base\Exception
     */
    public function encode($customPayload){
        $request = Yii::$app->getRequest();
        $signer = new Sha256();//使用Sha256加密，常用加密方式有Sha256,Sha384,Sha512
        $time = time();
        $tokenBuilder = (new Builder())
            ->issuedBy($request->getHostInfo()) // 设置发行人
            ->permittedFor(isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '') // 设置接收
            ->identifiedBy(Yii::$app->security->generateRandomString(10), true) // 设置id
            ->issuedAt($time) // 设置生成token的时间
            ->canOnlyBeUsedAfter($time) // 设置token使用时间(实时使用)
            ->expiresAt($time + $this->expire); //设置token过期时间
        //定义自己所需字段

        $tokenBuilder->withClaim($this->_payloadKey, $customPayload);

        //使用Sha256加密生成token对象，该对象的字符串形式为一个JWT字符串
        $token = $tokenBuilder->getToken($signer, new Key($this->jwt_secret));

        return (string)$token;
    }

    /**
     * @param $jwtToken
     * @return bool|Error
     */
    public function verify($jwtToken){
        $token = (new Parser())->parse($jwtToken);
        //数据校验
        $data = new ValidationData(); // 使用当前时间来校验数据
        if (!$token->validate($data)) {
            //数据校验失败
            return new Error("token过期");
        }
        //token校验
        $signer = new Sha256();//生成JWT时使用的加密方式
        if (!$token->verify($signer, new Key($this->jwt_secret))) {
            //token校验失败
            return new Error("token校验失败");
        }
        return true;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function decode($token) {
        $token = (new Parser())->parse($token);
        $token->getHeaders(); // 获取JWT的Header(头部)信息
        $token->getClaims(); // 获取JWT的PayLoad(负载)信息
        //获取指定参数的PayLoad(负载)信息
        return $token->getClaim($this->_payloadKey);
    }
}
