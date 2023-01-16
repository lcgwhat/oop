<?php
/**
 * @author: liuchg
 *
 */

namespace app\controllers;


use app\models\trace\FailLogForm;
use app\models\trace\TraceService;
use common\validates\MonthValidate;
use Exception;
use yii\validators\DateValidator;

class LogController extends Controller
{
    public function actionFailLog()
    {
        $form = new FailLogForm();
        $form->loadPost('');
        if (!$form->validate()) {
            return $this->jsonError($form->getError());
        }
        $service = new TraceService();
        $res = $service->traceLog($form);
        if (!$res) {
           return $this->jsonError($service->getError());
        }
        return $this->jsonSuccess('操作成功');
    }
    public function actionOtherLog()
    {
        $form = new FailLogForm();
        $form->loadPost('');
        if (!$form->validate()) {
            return $this->jsonError($form->getError());
        }
        $service = new TraceService();
        $res = $service->otherLog($form);
        if (!$res) {
            return $this->jsonError($service->getError());
        }
        return $this->jsonSuccess('操作成功');
    }
    public function actionMonthLog()
    {
        $month = \Yii::$app->request->get('month');
        $month = strtotime($month);
        if(!$month) {
            return $this->jsonError('时间格式错误');
        }
        $month =date('Y-m', $month);
        $monthValidator = new MonthValidate();
        $err = '';
        if (!$monthValidator->validate($month, $err)) {
            return $this->jsonError($err);
        }
        $service = new TraceService();
        $res = $service->getMonthDaily($month);

        return $this->jsonSuccess('',$res);
    }


}
