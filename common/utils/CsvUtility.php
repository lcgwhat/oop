<?php
/**
 * @author: liuchg
 *
 */

namespace common\utils;


use GuzzleHttp\Psr7\Stream;

class CsvUtility
{
    /**
     * <p>将数组生成csv文件格式的文本字符串</p>
     *
     * 文件通常分为二进制文件和文本文件。二进制文件是包含在 ASCII 及扩展 ASCII 字符中编写的数据或程序指令的文件。
     * 一般是可执行程序、图形、图象、声音等等文件。所以file_get_contents 的到的是文本文件字符串
     *
     * @param array $data
     * @param array $colHeaders
     * @param false $asString
     * @return false|string
     */
    function toCSV(array $data, array $colHeaders = array(), $asString = false) {
        /**
         * php://memory流类似如一个文件，支持读写操作；使用fopen()、fclose()函数打开流，
         * 使用fseek()、rewind()函数移动流指针， 使用ftell()、feof() 函数获取流指针当前的位置。
         * php://temp流与php://memory流用法和功能基本相同，只是默认当写入的数据达到2MB时，数据将由写入在内存变为写入到临时文件。
         * 写入的临时文件名为sys_get_temp_dir()函数获取的目录下以"php"开头的随机文件名；可以使用"php://temp/maxmemory:NN"形式设定超过NN字节时数据才写入到临时文件；php://temp流比较适合用于存放数据量比较大，且需要重复读取的数据。
         */
        $stream = ($asString)
            ? fopen("php://temp/maxmemory", "w+")
            : fopen("php://output", "w");//php://output 是一个只写的流，允许你以与print和echo相同的方式向输出缓冲区机制写入

        if (!empty($colHeaders)) {
            fputcsv($stream, $colHeaders);
        }

        foreach ($data as $record) {
            fputcsv($stream, $record);
        }

        if ($asString) {

            rewind($stream);// rewind()函数将文件指针的位置倒回文件的开头。
            // 这时候$stream 的指针位置位于最后，要将全部内容写入一个字符串，需要将指针倒回开头
            $returnVal = stream_get_contents($stream); // 与 file_get_contents() 一样，但是 stream_get_contents() 是对一个已经打开的资源流进行操作，并将其内容写入一个字符串返回。 返回的内容取决于 length 字节长度和 offset 指定的起始位置。
            fclose($stream);
            return $returnVal;
        }
        else {
            fclose($stream);
        }
    }
}
