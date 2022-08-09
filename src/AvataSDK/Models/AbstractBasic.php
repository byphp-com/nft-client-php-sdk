<?php

namespace AvataSDK\Models;

/**
 * 创建链账户
 */
abstract class AbstractBasic
{
    /**
     * //status=>HTTP状态码    statusCode=>CODE    msg=>说明
     *
     * @var array[]
     */
    public $errorEnums = [
        ['status' => 500, 'statusCode' => 'INTERNAL_ERROR', 'msg' => '内部服务错误',],
        ['status' => 404, 'statusCode' => 'NOT_FOUND', 'msg' => '访问信息不存在或暂时查询不到',],
        ['status' => 403, 'statusCode' => 'FORBIDDEN', 'msg' => '无访问权限',],
        ['status' => 400, 'statusCode' => 'BAD_REQUEST', 'msg' => '参数错误',],
        ['status' => 400, 'statusCode' => 'DUPLICATE_REQUEST', 'msg' => '重复请求',],
        ['status' => 400, 'statusCode' => 'STATUS_ERROR', 'msg' => '状态异常',],
    ];

    /**
     * 请求地址
     *
     * @var string
     */
    public $path;

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * path parameters
     *
     * @var array
     */
    public $pathParam;

    /**
     * query parameters
     *
     * @var array
     */
    public $queryParam;

    /**
     * request body schema
     *
     * @var array
     */
    public $bodyParam;

    /**
     * Responses
     *
     * @var array
     */
    public $response;

    /**
     * successful operation Responses
     *
     * @var array
     */
    public $data;

    /**
     * failed operation Responses
     *
     * @var array
     */
    public $error;

    public function __construct($params)
    {
        $this->pathParam  = $params['pathParam'] ?? [];
        $this->queryParam = $params['queryParam'] ?? [];
        $this->bodyParam  = $params['bodyParam'] ?? [];
        $this->buildPath($this->pathParam);
    }

    public function buildPath($pathParam)
    {
        $path = $this->path;
        if ($pathParam) {
            foreach ($pathParam as $key => $value) {
                $path = str_replace("{{$key}}", $value, $path);
            }
        }
        $this->path = $path;
    }
}