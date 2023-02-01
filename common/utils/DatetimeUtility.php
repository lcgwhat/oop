<?php
/**
 * @author: liuchg
 *
 */

namespace common\utils;


class DatetimeUtility
{
    /**
     * 取得最近30天的日期范围
     * @param string $time
     * @param string $format
     * @return array 返回起始和结束日期
     */
    public static function last30Days($time = 'now', $format = 'Y-m-d') {
        $date = new \DateTime($time);
        $end = $date->format($format);

        $date->modify('-29 day');
        $start = $date->format($format);

        return [
            'start'	=> $start,
            'end'	=> $end
        ];
    }

    /**
     * 格式化日期
     * @param string $time 时间，默认为当前时间
     * @param string $format 格式
     * @return string 返回格式化后的日期
     */
    public static function format($time = 'now', $format = 'Y-m-d') {
        $date = new \DateTime($time);
        return $date->format($format);
    }
}
