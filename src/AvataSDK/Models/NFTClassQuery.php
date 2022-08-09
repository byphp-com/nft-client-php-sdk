<?php

namespace AvataSDK\Models;

/**
 * 查询 NFT 类别
 */
class NFTClassQuery extends AbstractBasic
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
    public $method = 'GET';

    /**
     * Req
     *
     * @var string[]
     */
    public $queryParam = [
        'offset', //游标，默认为 0
        'limit', //每页记录数，默认为 10，上限为 50
        'id', //NFT 类别 ID
        'name', //NFT 类别名称，支持模糊查询
        'owner', //NFT 类别权属者地址
        'tx_hash', //创建 NFT 类别的 Tx Hash
        'start_date', //NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date', //NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by', //排序规则：DATE_ASC / DATE_DESC
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'offset',//游标
        'limit',//每页记录数
        'total_count',//总记录数
        //操作记录列表
        'classes' => [
            'id', //NFT 类别 ID
            'name', //NFT 类别名称
            'symbol', //NFT 类别标识
            'nft_count', //NFT 类别包含的 NFT 总量
            'uri', //链外数据链接
            'owner', //NFT 类别权属者地址
            'tx_hash', //创建 NFT 类别的 Tx Hash
            'timestamp', //创建 NFT 类别的时间戳（UTC 时间）
        ],
    ];

}