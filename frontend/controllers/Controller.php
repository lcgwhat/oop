<?php
/**
 * Controller.php
 * atuthor: liuchg
 */

namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class Controller extends \yii\web\Controller
{
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => $rules
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
                'fixedVerifyCode' => 'xsdas',
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 6, //最大显示个数
                'minLength' => 5,//最少显示个数
                'padding' => 5,//间距
                'height'=>40,//高度
                'width' => 130,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4,        //设置字符偏移量 有效果
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
}
