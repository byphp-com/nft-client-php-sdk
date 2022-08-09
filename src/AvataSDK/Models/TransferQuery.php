<?php

namespace AvataSDK\Models;

/**
 * 上链交易结果查询
 */
class TransferQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/tx/{operation_id}';

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
        'operation_id', //操作 ID
    ];


    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'type',//用户操作类型 Enum: "issue_class" "mint_nft" "edit_nft" "burn_nft" "transfer_class" "transfer_nft"
        'tx_hash',//交易哈希
        'status',//交易状态, 0 处理中; 1 成功; 2 失败; 3 未处理
        'class_id',//类别 ID
        'nft_id',//NFT ID
        'message',//错误描述
        'block_height',//交易上链的区块高度
        'timestamp',//交易上链时间（UTC 时间）
        //交易标签, 自定义 key：支持大小写英文字母和汉字和数字，长度6-12位，自定义 value：长度限制在64位字符，支持大小写字母和数字
        'tag' => [
            'key1', //链账户地址
            'key2', //链账户名称
            'key3', //Gas 余额
        ],
    ];

}
