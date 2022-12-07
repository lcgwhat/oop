<?php
/**
 * ApiController.php
 * @author liuchg
 */

namespace app\controllers;


use yii\web\HttpException;


class ApiController extends \yii\web\Controller
{



    public function actions()
    {
        return [
            'error' => [
                'class' => 'app\action\ErrorApiAction',
            ],
        ];
    }

    public function actionDo(){
        //set_error_handler();
       // set_exception_handler([$this,'hah']);
       //return ['12'=>12];
        throw new HttpException(404,'xxx',300);

    }
    public function hah(){
        echo "这里是自定义异常处理";
    }
}
