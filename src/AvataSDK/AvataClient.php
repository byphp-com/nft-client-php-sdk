<?php

namespace AvataSDK;

use AvataSDK\Models\AbstractBasic;
use AvataSDK\Utils\CommonUtil;

/**
 * 访问Avata API的Client类
 * Class AvataClient
 */
class AvataClient
{
    private $domains = [
        'test' => 'https://stage.apis.avata.bianjie.ai', //测试环境的访问域名
        'prod' => 'https://apis.avata.bianjie.ai', //生产环境的访问域名
    ];

    protected $apiDomain;
    protected $apiKey;
    protected $apiSecret;
    protected $debugMode;
    protected $timeout;

    /**
     * AvataClient constructor.
     *
     * @param $config [
     *                'apiKey'    => "M212B0U781X3T0g4h1o9U4q3u77276K",
     *                'apiSecret' => "L222O0H7S1H3A044U1J9G4k3e7P2Y6I",
     *                'apiDomain' => "https://stage.apis.avata.bianjie.ai",
     *                ]
     *
     * @throws ClientException
     */
    public function __construct($config)
    {
        CommonUtil::writeLog(['_construct_data' => $config]);
        if (!isset($config['apiDomain']) || !$config['apiDomain']) {
            throw new ClientException('404', '访问域名未配置');
        }
        if (!isset($config['apiKey']) || !$config['apiKey']) {
            throw new ClientException('404', 'ApiKey未配置');
        }
        if (!isset($config['apiSecret']) || !$config['apiSecret']) {
            throw new ClientException('404', 'ApiSecret未配置');
        }
        $this->apiDomain = trim($config['apiDomain']);
        $this->apiKey    = trim($config['apiKey']);
        $this->apiSecret = trim($config['apiSecret']);
        $this->debugMode = $config['debugMode'] ?? false;
        $this->timeout   = $config['timeout'] ?? 0;
    }

    public function execute(AbstractBasic $requestModel)
    {
        CommonUtil::writeLog(['_requestModel' => $requestModel]);
        $path       = $requestModel->path;
        $method     = $requestModel->method;
        $queryParam = $requestModel->queryParam;
        $bodyParam  = $requestModel->bodyParam;
        $data       = [
            'path'       => $path,
            'queryParam' => $queryParam,
            'bodyParam'  => $bodyParam,
        ];
        // 获取时间
        $timestamp = CommonUtil::getMillisecond();
        // 获取签名
        $hexHash = CommonUtil::sign($data, $timestamp, $this->apiSecret);
        // 获取请求头信息
        $header = [
            "Content-Type:application/json",
            "X-Api-Key:{$this->apiKey}",
            "X-Signature:{$hexHash}",
            "X-Timestamp:{$timestamp}",
        ];
        // 获取请求响应response
        $apiGateway = CommonUtil::buildRequestGateway($this->apiDomain, $path, $queryParam);
        CommonUtil::writeLog(['_apiGateway' => $apiGateway, 'method' => $method, '_header' => $header, 'bodyParam' => $bodyParam]);
        $response = CommonUtil::getResponse($apiGateway, $method, $header, $bodyParam);
        CommonUtil::writeLog(['_apiGateway' => $apiGateway, 'method' => $method, '_header' => $header, 'bodyParam' => $bodyParam, 'response' => $response]);
        $response = json_decode($response, true);

        return $response;

    }


}