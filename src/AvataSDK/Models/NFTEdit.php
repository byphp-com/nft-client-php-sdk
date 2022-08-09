<?php

namespace AvataSDK\Models;

/**
 * 编辑NFT
 */
class  NFTEdit extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/nfts/{class_id}/{owner}/{nft_id}';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'PATCH';

    /**
     * 请求地址参数
     *
     * @var string[]
     */
    public $pathParam = [
        'class_id', //NFT 类别 ID
        'owner', //NFT 持有者地址，也是 Tx 签名者地址
        'nft_id', //NFT ID
    ];


    /**
     * 请求参数
     *
     * @var string[]
     */
    public $bodyParam = [
        'name', //NFT 名称
        'uri', //链外数据链接
        'data', //自定义链上元数据
        'tag', //交易标签, 自定义 key：支持大小写英文字母和汉字和数字，长度6-12位，自定义 value：长度限制在64位字符，支持大小写字母和数字
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
        'operation_id', //操作ID
    ];
}