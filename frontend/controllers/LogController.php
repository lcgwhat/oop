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
    public function actionMonthLog()
    {
        $month = \Yii::$app->request->get('month');
        $monthValidator = new MonthValidate();
        if (!$monthValidator->validate($month)) {
            return $this->jsonError('格式错误');
        }
        $service = new TraceService();
        $res = $service->getMonthDaily($month);

        return $this->jsonSuccess('',$res);
    }
}
