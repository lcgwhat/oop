<?php
/**
 * ErrorApiAction.php
 * @author liuchg
 */

namespace app\action;


use yii\web\ErrorAction;
use yii\web\Response;

class ErrorApiAction extends ErrorAction
{
    public function run(){
        \Yii::$app->getResponse()->setStatusCodeByException($this->exception);
        // json格式返回
        \Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        // 返回数据
        return [
            'msg' => $this->exception->getMessage(),
            'err' => $this->exception->getCode()
        ];
    }
}
