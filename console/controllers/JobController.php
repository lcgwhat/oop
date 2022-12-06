<?php
/**
 * @author: liuchg
 *
 */

/**
 * php index.php index/index
 */
namespace console\controllers;


use console\models\JobModel;

class JobController extends \yii\console\Controller
{
    public function actionIndex(){
       $modle = new JobModel();
       $modle->doSay();
    }
}
