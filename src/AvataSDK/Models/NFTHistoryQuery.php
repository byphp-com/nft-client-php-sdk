<?php

namespace AvataSDK\Models;

/**
 * 查询NFT操作记录
 */
class  NFTHistoryQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/nfts/{class_id}/{nft_id}/history';

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
        'class_id', //NFT 类别 ID
        'nft_id', //NFT ID
    ];


    /**
     * 请求参数
     *
     * @var string[]
     */
    public $queryParam = [
        'offset',//游标，默认为 0
        'limit',//每页记录数，默认为 10，上限为 50
        'signer',//Tx 签名者地址
        'tx_hash',//NFT 操作 Tx Hash
        'operation',//操作类型：mint / edit / transfer / burn
        'start_date',//NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date',//NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by',//排序规则：DATE_ASC / DATE_DESC
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
        //NFT 列表
        'operation_records' => [
            'tx_hash', //NFT 操作的 Tx Hash
            'operation', //NFT 操作类型 Enum: "mint" "edit" "transfer" "burn"
            'signer', //Tx 签名者地址
            'recipient', //NFT 接收者地址
            'timestamp', //NFT 操作时间戳（UTC 时间）
        ],
    ];

}
