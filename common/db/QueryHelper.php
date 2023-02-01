<?php
/**
 * @author: liuchg
 *
 */

namespace common\db;


use common\utils\DatetimeUtility;

class QueryHelper
{
    /**
     * @param $column
     * @param $range
     * @param string $format
     * @return string[]
     */
    public static function dateRange($column, $range, $format='Y-m-d'){
        $conditions = ['AND'];
        if (empty($range)) {
            return $conditions;
        }
        $times = explode('/', $range);
        $start = (isset($times[0]))? $times[0]:null;
        $end = (isset($times[1]))? $times[1]:null;
        if ($start) {
            $start = self::formatDate($start, $format);
            if ($start) {
                $condition = ['>=', $column, $start];
            }
            else {
                $condition = '1=0';
            }
            $conditions[] = $condition;
        }
        if ($end) {
            $end = self::formatDate($end, $format);
            if ($end) {
                $condition = ['<=', $column, $end];
            }
            else {
                $condition = '1=0';
            }
            $conditions[] = $condition;
        }

        return $conditions;
    }
    private static function formatDate($date, $format) {
        try {
            return DateTimeUtility::format($date, $format);
        } catch (\Exception $e) {
            return false;
        }
    }
}
