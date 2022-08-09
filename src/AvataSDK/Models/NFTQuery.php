<?php

namespace AvataSDK\Models;

/**
 * 查询 NFT
 */
class  NFTQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/nfts';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * 请求参数
     *
     * @var string[]
     */
    public $queryParam = [
        'offset', //游标，默认为 0
        'limit', //每页记录数，默认为 10，上限为 50
        'id', //NFT ID
        'class_id', //NFT 类别 ID
        'owner', //NFT 持有者地址
        'tx_hash', //创建 NFT 的 Tx Hash
        'start_date', //NFT 创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date', //NFT 创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by', //排序规则：ID_ASC / ID_DESC / DATE_ASC / DATE_DESC
        'status', //NFT 状态：active / burned，默认为 active
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'offset',
        'limit',
        'total_count',
        'nfts' => [
            'id', //NFT ID
            'name', //NFT 名称
            'class_id', //NFT 类别 ID
            'class_name', //NFT 类别 名称
            'class_symbol', //NFT 类别标识
            'uri', //链外数据链接
            'owner', //NFT 持有者地址
            'status', //NFT 状态：Active; Burned;
            'tx_hash', //NFT 发行 Tx Hash
            'timestamp', //NFT 发行时间戳（UTC 时间）
        ],
    ];

}