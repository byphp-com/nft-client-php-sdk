<?php

namespace AvataSDK\Models;

/**
 * 查询链账户
 */
class AccountQuery extends AbstractBasic
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
    public $method = 'GET';

    /**
     * GET请求参数
     *
     * @var string[]
     */
    public $queryParam = [
        'offset', //游标，默认为 0
        'limit', //每页记录数，默认为 10，上限为 50
        'name', //链账户名称，支持模糊查询
        'account', //链账户地址
        'start_date', //创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date', //创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by', //排序规则：DATE_ASC / DATE_DESC
        'operation_id', //操作 ID
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
        //链账户列表
        'accounts' => [
            'account', //链账户地址
            'name', //链账户名称
            'gas', //Gas 余额
            'business', //业务费余额
            'operation_id', //操作 ID
            'status', //链账户的授权状态，0 未授权；1 已授权
        ],
    ];

}
