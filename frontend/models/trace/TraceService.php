<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\trace;


use app\models\Service;

use common\models\trace\DailyTrace;

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
                $fails[$trace->trace_date] = $trace->getAttributes()+['typeName'=>$trace->isFail()?'失败':'其他'];
            }
            $events[$trace->trace_date][] = $trace->getAttributes()+['typeName'=>$trace->isFail()?'失败':'其他'];
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


}
