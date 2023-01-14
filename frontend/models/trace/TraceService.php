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
        $query->andWhere(['type' => DailyTrace::TYPE_FAIL]);
        $query->andWhere(['DATE_FORMAT(trace_date, "%Y-%m")' => $month]);
        $query->orderBy(['trace_date'=>SORT_ASC]);
        $query->asArray();
        return $query->all();
    }

    public function getDayEvent( $day)
    {
        $unixTime = strtotime($day);
        $day = date('Y-m-d', $unixTime);
        $query = DailyTrace::find();
        $query->andWhere(['account_id' => self::getUserId()]);
        $query->andWhere(['DATE_FORMAT(trace_date, "%Y-%m-%d")' => $day]);
        $query->orderBy(['trace_date'=>SORT_ASC]);
        $query->asArray();
        return $query->all();
    }


}
