<?php

namespace AvataSDK\Models;

/**
 * 查询链账户操作记录
 */
class AccountHistoryQuery extends AbstractBasic
{

    /**
     * 查询链账户操作记录
     *
     * @var string
     */
    public $path = '/v1beta1/accounts/history';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * @var string[]
     */
    public $queryParam = [
        'offset', //游标，默认为 0
        'limit', //每页记录数，默认为 10，上限为 50
        'account', //链账户地址
        'module', //功能模块：account / nft
        'operation', // 操作类型，仅 module 不为空时有效，默认为 ”all“; module = account 时可选：add_gas; module = nft 时可选：transfer_class / mint / edit / transfer / burn / issue_class
        'start_date', //创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date', //创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by', //排序规则：DATE_ASC / DATE_DESC
        'tx_hash', //Tx Hash
    ];
}