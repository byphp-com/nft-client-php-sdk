<?php

namespace AvataSDK\Utils;

use ClientException;

/**
 * Class CommonUtil
 */
class CommonUtil
{

    /**
     * 对数据处理，并进行签名
     *
     * @param $data
     * @param $timestamp
     * @param $apiSecret
     *
     * @return string
     */
    public static function sign($data, $timestamp, $apiSecret)
    {
        $path   = $data['path'] ?? '';
        $params = ["path_url" => $path];

        $queryParam = $data['queryParam'] ?? [];
        if ($queryParam) {
            // 组装 query
            foreach ($queryParam as $k => $v) {
                $params["query_{$k}"] = $v;
            }
        }
        $bodyParam = $data['bodyParam'] ?? [];
        if ($bodyParam) {
            // 组装 post body
            foreach ($bodyParam as $k => $v) {
                $params["body_{$k}"] = $v;
            }
        }
        // 数组递归排序
        $params  = self::SortAll($params);
        $hexHash = hash("sha256", "{$timestamp}" . $apiSecret);
        if (count($params) > 0) {
            // 序列化且不编码
            $jsonStr = json_encode($params, JSON_UNESCAPED_UNICODE);
            $hexHash = hash("sha256", stripcslashes($jsonStr . "{$timestamp}" . $apiSecret));
        }
        return $hexHash;
    }

    /**
     * 构造请求接口地址
     *
     * @param $apiDomain
     * @param $path
     * @param $query
     *
     * @return string
     */
    public static function buildRequestGateway($apiDomain, $path, $query = '')
    {
        return rtrim($apiDomain, '/') . '/' . ltrim($path, '/') . ($query ? '?' . http_build_query($query) : '');
    }

    /**
     * 执行请求
     *
     * @param $apiGateway
     * @param $method
     * @param $header
     * @param $bodyParam
     * @param $isSsl
     *
     * @return bool|string
     */
    public static function getResponse($apiGateway, $method, $header = [], $bodyParam = '', $isSsl = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiGateway);
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $jsonStr = is_array($bodyParam) ? json_encode($bodyParam) : $bodyParam; //转换为json格式
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($jsonStr) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($isSsl) {
            //部分PHP版本curl默认不验证https证书，返回NULL
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
        }
        $response = curl_exec($ch);
        curl_error($ch);
        curl_errno($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * 生成一个随机的req msg id，用于在日志中定位请求
     */
    public static function generateReqMsgId()
    {
        return md5(uniqid('', true));
    }

    /**
     * 获取当前的日期
     *
     * @return false|string
     */
    public static function generateIsoFormatCurrentDate()
    {
        return date('c');
    }


    /** get timestamp
     *
     * @return float
     */
    public static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)));
    }

    /**
     * 数组递归排序
     *
     * @param $params
     *
     * @return mixed
     */
    public static function SortAll(&$params)
    {
        if (is_array($params)) {
            ksort($params);
        }
        foreach ($params as &$v) {
            if (is_array($v)) {
                self::SortAll($v);
            }
        }
        return $params;
    }

    /**
     * 记录日志
     *
     * @param $log_data
     * @param $log_path
     *
     * @return bool
     */
    public static function writeLog($log_data, $log_path = '')
    {
        try {
            if ($log_path) {
                $dir = $log_path;
            } else {
                $dir = dirname(__DIR__) . '/Logs';
            }
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                chmod($dir, 0777);
            }

            $file = date('Ymd') . '.log';
            if (is_array($log_data))
                $log_data = var_export($log_data, true);
            $str    = date('Y-m-d H:i:s') . " : " . $log_data . "\r\n";
            $handle = fopen($dir . '/' . $file, 'a+');
            fwrite($handle, $str);
            fclose($handle);
            return true;
        } catch (\Exception $e) {
            $e->getMessage();
            return false;
        }
    }
}