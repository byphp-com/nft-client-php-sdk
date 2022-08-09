<?php

namespace AvataSDK\Models;

/**
 * 购买能量值/业务费
 */
class  OrderBuy extends AbstractBasic
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
    public $method = 'POST';

    /**
     * 请求参数
     *
     * @var string[]
     */
    public $bodyParam = [
        'account', //链账户地址
        'amount', //购买金额 ，只能购买整数元金额；单位：分
        'order_type', //充值类型：gas：能量值；business：业务费
        'order_id', //自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'order_id', //交易流水号（用户发起交易时传入的交易流水号)
    ];

}