<?php
/**
 * @author: liuchg
 *
 */

namespace app\controllers;


use app\models\trace\FailLogForm;
use app\models\trace\TraceService;
use common\models\trace\DailyTrace;
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
    public function actionStockLog()
    {
        $form = new FailLogForm();
        $form->loadPost('');
        if (!$form->validate()) {
            return $this->jsonError($form->getError());
        }
        $service = new TraceService();
        $res = $service->stockLog($form);
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

    public function actionGetSpecificTypeLogs(){
        $type = \Yii::$app->request->get('type', 'stock');
        $typesMap = [
            'stock' => DailyTrace::TYPE_STOCk,
            'fail' => DailyTrace::TYPE_FAIL,
            'other' => DailyTrace::TYPE_OTHER];
        if (!in_array($type, array_keys($typesMap))) {
            return $this->jsonError('类型错误');
        }
        $sort = \Yii::$app->request->get('sort', 'desc');
        if ($sort == 'desc') {
            $sort = SORT_DESC;
        }else{
            $sort = SORT_ASC;
        }
        $month = \Yii::$app->request->get('month');
        $month = strtotime($month);
        if(!$month) {
            return $this->jsonError('时间格式错误');
        }
        $month =date('Y-m-d', $month);
        $monthValidator = new MonthValidate();
        $monthValidator->format = ['Y-m-d', 'Y/m/d'];
        $err = '';
        if (!$monthValidator->validate($month, $err)) {
            return $this->jsonError($err);
        }
        $service = new TraceService();
        $res = $service->getSpecificTypeLogs($month, $typesMap[$type],$sort);

        return $this->jsonSuccess('',$res);
    }
}
