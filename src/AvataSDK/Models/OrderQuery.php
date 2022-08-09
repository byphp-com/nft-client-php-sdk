<?php

namespace AvataSDK\Models;

/**
 * 查询能量值/业务费购买结果列表
 */
class  OrderQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/orders';
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
        'offset', //string 游标，默认为 0
        'limit', //string 每页记录数，默认为 10，上限为 50
        'start_date', //string 充值订单创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
        'end_date', //string 充值订单创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
        'sort_by', //string排序规则：DATE_ASC / DATE_DESC，默认为 DATE_DESC
        'status', //string 订单状态：success 充值成功 / failed 充值失败 / pending 正在充值
    ];

}