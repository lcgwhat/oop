<?php
/**
 * Controller.php
 * atuthor: liuchg
 */

namespace app\controllers;

use common\filters\Authorization;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;

class Controller extends \yii\web\Controller
{
    public function withoutAuthorization(){
        return [];
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        $rules = [];

        // 错误页面任意情况下均可访问
        $rules[] = [
            'allow' => true,
            'controllers' => ['site'],
            'actions' => ['error'],
        ];
        // 未登录也可访问的action
        $actions = $this->accessAllow();
        if (!empty($actions)) {
            $rules[] = [
                'allow' => true,
                'actions' => $actions,
            ];
        }
        // 登录后可以访问所有action
        $rules[] = [
            'allow' => true,
            'roles' => ['@'],
        ];
        return [
            'authorization' => [
                'class' => Authorization::class,
                'exclude' => array_merge($this->withoutAuthorization(), $this->accessAllow())
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => $rules
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbFilter(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    protected function accessAllow()
    {
        return [];
    }
    protected function verbFilter() {
        return [];
    }
    public function jsonError($message, $data = [], $code = null) {
    $code = ($code)? $code:100;
    $result = [
        'code'	 =>$code,
        'message'=>$message,
        'data'	 =>$data,
    ];

    return Json::encode($result);
}

    public function jsonSuccess($message='', $data = null) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = ($data===null && is_array($message))? $message:$data;
        $message = (is_string($message))? $message:null;

        $result = [
            'code'=>200,
            'message'=>$message,
            'data'=>$data,
        ];

        return $result;
    }
}
