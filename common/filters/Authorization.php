<?php
/**
 * @author: liuchg
 *
 */

namespace common\filters;



use common\components\JWT;
use common\models\account\UserIdentity;
use common\models\Error;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class Authorization extends ActionFilter
{
    /**
     * @var array 排除清单，清单内的action不做权限验证(未登录)
     */
    public $exclude = [];
    public function beforeAction($action)
    {
        if (in_array($action->id, $this->exclude)) {
            return true;
        }

        // jwt 检查
        $headers = \Yii::$app->request->getHeaders();
        $jwtToken = $headers->get('authorization');
        if (empty($jwtToken)) {
            throw new ForbiddenHttpException("token 不能为空");
        }
        /**
         * @var $jwt JWT
         */
        $jwt = \Yii::$app->get('jwt');
        $res = $jwt->verify($jwtToken);
        if (Error::isError($res)) {
            throw new ForbiddenHttpException($res->getError());
        }
        $userId = $jwt->decode($jwtToken);
        if (!is_numeric($userId)) {
            throw new ForbiddenHttpException("token 错误");
        }

        $user = UserIdentity::findIdentity($userId);
        if (is_null($user)) {
            throw new ForbiddenHttpException("用户不存在");
        }
        \Yii::$app->user->login($user);

        return true;
    }
}
