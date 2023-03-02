<?php
/**
 * @author: liuchg
 *
 */

namespace common\utils;


class CsvUtility
{
    /**
     * 将数组生成csv文件格式文件 二进制字符串
     * @param array $data
     * @param array $colHeaders
     * @param false $asString
     * @return false|string
     */
    function toCSV(array $data, array $colHeaders = array(), $asString = false) {
        $stream = ($asString)
            ? fopen("php://temp/maxmemory", "w+")
            : fopen("php://output", "w");

        if (!empty($colHeaders)) {
            fputcsv($stream, $colHeaders);
        }

        foreach ($data as $record) {
            fputcsv($stream, $record);
        }

        if ($asString) {
            rewind($stream);
            $returnVal = stream_get_contents($stream);
            fclose($stream);
            return $returnVal;
        }
        else {
            fclose($stream);
        }
    }
}
