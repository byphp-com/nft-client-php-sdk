<?php

namespace AvataSDK\Models;

/**
 * 转让 NFT 类别
 * NFT 类别权属者（NFT Class Owner），拥有在该 NFT 类别中发行 NFT 的权限和转让该 NFT 类别的权限。
 * 注意：「Avata」API 服务平台「允许」应用平台方将 NFT 类别转让给「任一 Avata 平台内合法链账户地址」。
 */
class  NFTClassTransfer extends AbstractBasic
{
    /**
     * 请求地址
     *
     * @var string
     */
    public $path = '/v1beta1/nft/class-transfers/{class_id}/{owner}';

    /**
     * 请求方法
     *
     * @var string
     */
    public $method = 'POST';

    /**
     * 请求地址参数
     *
     * @var string[]
     */
    public $pathParam = [
        'class_id', //NFT 类别 ID
        'owner', //NFT 类别权属者地址
    ];

    /**
     * 请求参数
     *
     * @var string[]
     */
    public $bodyParam = [
        'recipient', //NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址
        'operation_id', //操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的、针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串
        'tag', //交易标签, 自定义 key：支持大小写英文字母和汉字和数字，长度6-12位，自定义 value：长度限制在64位字符，支持大小写字母和数字
    ];

    /**
     * 结果数据对象
     *
     * @var array
     */
    public $data = [
        'operation_id', //操作 ID
    ];

}