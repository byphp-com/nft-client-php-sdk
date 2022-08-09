<?php

namespace AvataSDK\Models;

/**
 * 创建NFT类别
 */
class NFTClassCreate extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/classes';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'POST';


    /**
     * 请求参数
     *
     * @var string[]
     */
    public $bodyParam = [
        'name', //链账户名称，支持 1-20 位汉字、大小写字母及数字组成的字符串
        'symbol', //标识
        'description', //描述
        'uri', //链外数据链接
        'uri_hash', //链外数据 Hash
        'data', //自定义链上元数据
        'owner', //NFT 类别权属者地址，支持任一文昌链合法链账户地址
        //交易标签, 自定义 key：支持大小写英文字母和汉字和数字，长度6-12位，自定义 value：长度限制在64位字符，支持大小写字母和数字
        'tag' => [
            'key1', //链账户地址
            'key2', //链账户名称
            'key3', //Gas 余额
        ],
        //操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；
        //由接入方生成的、针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串
        'operation_id',
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'operation_id', //操作 ID
    ];

}