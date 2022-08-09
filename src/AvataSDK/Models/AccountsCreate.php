<?php

namespace AvataSDK\Models;

/**
 * 批量创建链账户
 */
class AccountsCreate extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/accounts';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'POST';

    /**
     * POST请求参数
     *
     * @var string[]
     */
    public $bodyParam = [
        'count', //链账户名称，支持 1-20 位汉字、大小写字母及数字组成的字符串
        //操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的、
        //针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串
        'operation_id',
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'accounts', //链账户地址列表
        'operation_id', //操作 ID
    ];

}