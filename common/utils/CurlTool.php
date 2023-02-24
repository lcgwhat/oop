<?php
/**
 * @author: liuchg
 *
 */

namespace common\utils;


use common\models\LogicModel;

class CurlTool extends LogicModel
{
    /**
     * 使用curl上传文件
     * @param $url
     * @param $attributes
     * @param $files
     * @return false
     */
    public function postStream($url, $attributes, $files){
        $data = '';
        $boundaryText = uniqid('mancando');
        foreach ($attributes as $key => $value) {
            $data .= $this->formatTextParamsStream($boundaryText, $key , $value);
        }

        foreach ($files as $file) {
            $temp = $this->formatFileStream($boundaryText, $file);
            if ($temp === false) {
                return false;
            }
            $data .= $temp;

            $data .= $this->formatTextParamsStream($boundaryText, $file['name'] , $file['path']);
        }

        $data .= "--" . $boundaryText . "--\r\n";
        $curlOptions = [
            CURLOPT_HTTPHEADER => [
                "Content-Type: multipart/form-data; boundary=" . $boundaryText,
            ],
        ];
        $this->_logger->log($url);
        $this->_logger->log($data);
        $result = $this->post($url, $data, $curlOptions);
        if ($result === false) {
            return $this->setError($this->requestError($this->_curl->getError()));
        }
        $this->_logger->log('response:'.$result);

        return $this->decode($result);
    }
    private function formatTextParamsStream($boundaryText, $key, $value) {
        $data = '';
        if (is_array($value)) {
            foreach ($value as $key2 => $value2) {
                $data .= $this->formatTextParamsStream($boundaryText, "{$key}[{$key2}]", $value2);
            }
        } else {
            $data = "--" . $boundaryText . "\r\n" . 'Content-Disposition: form-data; name="' . $key . "\"\r\n\r\n" . $value . "\r\n";
        }

        return $data;
    }
    /**
     * @param string $boundaryText
     * @param array $file
     *  name string 传输给对方字段名
     *  filename string 文件名
     *  contentType string 内容类型
     *  path string 文件路径
     * @return string|boolean
     */
    private function formatFileStream($boundaryText, $file) {
        $data = "--" . $boundaryText . "\r\n". 'Content-Disposition: form-data; name="'.$file['name'].'"; filename="' . $file['filename'] . '"' . "\r\n". 'Content-Type:'.($file['contentType'] ?? 'application/octet-stream')."\r\n\r\n";

        if(isset($file['data'])) {
            $data .= $file['data'] . "\r\n";

            return $data;
        }

        try {
            $data .= file_get_contents($file['path']) . "\r\n";
        } catch (\Exception $exception) {
            return $this->setError('获取文件内容失败！');
        }

        return $data;
    }

    /**
     * post
     * @param string $url 地址
     * @param array $data post数据
     * @param array $curlOptions curl参数
     * @return string 失败返回false，成功返回具体内容
     */
    public function post($url, $data = null, $curlOptions = []) {
        if (is_array($data)) {
            $data = http_build_query($data);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//设置是否返回信息
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//POST数据
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        foreach ($curlOptions as $curlOptionKey => $curlOptionValue) {
            curl_setopt($ch, $curlOptionKey, $curlOptionValue);
        }

        $result = curl_exec($ch);

        if($result === false) {
            $rs = curl_error($ch);
            $errorCode = curl_errno($ch);
            curl_close($ch);
            return $this->setError('获取数据失败:'."错误码“{$errorCode}”,错误信息“{$rs}”");
        }

        curl_close($ch);

        return $result;
    }
    public $timeout = 3000;
}
