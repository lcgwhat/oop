<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\trace;


use app\models\Service;

use common\db\QueryHelper;
use common\models\trace\DailyTrace;
use common\utils\DatetimeUtility;

class TraceService extends Service
{
    public function traceLog(FailLogForm $form) {
        if (DailyTrace::existFailByAccountAndDate(self::getUserId(), $form->date)) {
            return $this->setError('当天已经记录');
        }
        $trace = new DailyTrace();
        $trace->trace_date = $form->date;
        $trace->type = DailyTrace::TYPE_FAIL;
        $trace->account_id = self::getUserId();
        $trace->note = str_replace(PHP_EOL,'',$form->note);
        if (!$trace->save()) {
            return $this->addErrors($trace->getErrors());
        }

        return true;
    }
    public function getSpecificTypeLogs($month, $type, $sort=SORT_DESC){
        return $this->getStockLogs($month, $type, $sort);
    }

    public function getStockLogs($month, $type, $sort=SORT_ASC){
        $unixTime = strtotime($month);
        $month = date('Y-m-d', $unixTime);
        $rangeDate = DatetimeUtility::last30Days($month);
        $dateRange = implode('/',[$rangeDate['start'], $rangeDate['end']]);
        $query = DailyTrace::find();
        $query->andWhere(['account_id' => self::getUserId()]);
        $query->andWhere(['type' => $type]);

        $query->andWhere(QueryHelper::dateRange('trace_date', $dateRange));
        $query->orderBy(['trace_date'=>$sort, 'id'=>SORT_DESC]);
        $traces= $query->all();
        $events = [];
        foreach ($traces as $trace) {
            $events[] = $trace->getAttributes()+['typeName'=>$trace->typeName];
        }
        return $events;
    }
    public function getMonthDaily($month){
        $unixTime = strtotime($month);
        $month = date('Y-m', $unixTime);
        $query = DailyTrace::find();
        $query->andWhere(['account_id' => self::getUserId()]);
        $query->andWhere(['DATE_FORMAT(trace_date, "%Y-%m")' => $month]);
        $query->orderBy(['trace_date'=>SORT_ASC]);

        $traces= $query->all();
        $events = [];
        $fails = [];
        foreach ($traces as $trace) {
            /**
             * @var $trace DailyTrace
             */
            if ($trace->isFail()) {
                $fails[$trace->trace_date] = $trace->getAttributes()+['typeName'=>$trace->typeName];
            }
            $events[$trace->trace_date][] = $trace->getAttributes()+['typeName'=>$trace->typeName];
        }

        return [
            'events' => $events,
            'fails' => $fails
        ];
    }

    public function otherLog(FailLogForm $form)
    {
        $trace = new DailyTrace();
        $trace->trace_date = $form->date;
        $trace->type = DailyTrace::TYPE_OTHER;
        $trace->account_id = self::getUserId();
        $trace->note = $form->note;
        if (!$trace->save()) {
            return $this->addErrors($trace->getErrors());
        }

        return true;
    }
    public function stockLog(FailLogForm $form){
        $trace = new DailyTrace();
        $trace->trace_date = $form->date;
        $trace->type = DailyTrace::TYPE_STOCk;
        $trace->account_id = self::getUserId();
        $trace->note = $form->note;
        if (!$trace->save()) {
            return $this->addErrors($trace->getErrors());
        }

        return true;
    }

}
