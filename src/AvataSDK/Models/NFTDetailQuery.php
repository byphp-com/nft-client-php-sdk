<?php

namespace AvataSDK\Models;
/**
 * 查询 NFT 详情
 */
class  NFTDetailQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/nfts/{class_id}/{nft_id}';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * 请求地址参数
     *
     * @var string[]
     */
    public $pathParam = [
        'class_id', //NFT类别ID
        'nft_id', //NFT ID
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'id', //NFT ID
        'name', //NFT 名称
        'class_id', //NFT 类别 ID
        'class_name', //NFT 类别 名称
        'class_symbol', //NFT 类别标识
        'uri', //链外数据链接
        'uri_hash', //链外数据 Hash
        'data', //自定义链上元数据
        'owner', //NFT 持有者地址
        'status', //NFT 状态：Active; Burned;
        'tx_hash', //NFT 发行 Tx Hash
        'timestamp', //NFT 发行时间戳（UTC 时间）
    ];

}