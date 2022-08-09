<?php

namespace AvataSDK\Models;

/**
 * 查询能量值/业务费购买结果
 * 指定的 OrderID，查询相关的订单信息。
 */
class  OrderResultQuery extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/orders/{order_id}';
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
    public $pathParam = [
        'order_id', //Order ID
    ];

}