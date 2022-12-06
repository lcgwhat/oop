<?php

namespace app\controllers;

class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //\Yii::$app->user->identity
        return $this->render('index');
    }

}
