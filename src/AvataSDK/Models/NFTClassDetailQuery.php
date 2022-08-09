<?php

namespace AvataSDK\Models;
/**
 * 查询 NFT 类别详情
 */
class  NFTClassDetailQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/classes/{id}';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * Req
     *
     * @var string[]
     */
    public $pathParam = [
        'id', //NFT类别ID
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'id', //NFT 类别 ID
        'name', //NFT 类别名称
        'symbol', //NFT 类别标识
        'description', //NFT 类别描述
        'nft_count', //NFT 类别包含的 NFT 总量
        'uri', //链外数据链接
        'uri_hash', //链外数据 Hash
        'data', //自定义链上元数据
        'owner', //NFT 类别权属者地址
        'tx_hash', //创建 NFT 类别的 Tx Hash
        'timestamp', //创建 NFT 类别的时间戳（UTC 时间）
    ];

}