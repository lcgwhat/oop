<?php
/**
 * @author: liuchg
 *
 */

namespace common\module\template\controllers;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(){
        return $this->asJson(['data'=>11]);
    }
}
