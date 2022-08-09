<?php

use AvataSDK\AvataClient;
use AvataSDK\Models\AccountCreate;
use AvataSDK\Models\AccountHistoryQuery;
use AvataSDK\Models\AccountQuery;
use AvataSDK\Models\NFTClassCreate;
use AvataSDK\Models\NFTClassDetailQuery;
use AvataSDK\Models\NFTClassQuery;
use AvataSDK\Models\NFTClassTransfer;
use AvataSDK\Models\NFTCreate;
use AvataSDK\Models\NFTDelete;
use AvataSDK\Models\NFTDetailQuery;
use AvataSDK\Models\NFTEdit;
use AvataSDK\Models\NFTHistoryQuery;
use AvataSDK\Models\NFTQuery;
use AvataSDK\Models\NFTTransfer;
use AvataSDK\Models\OrderBuy;
use AvataSDK\Models\OrderQuery;
use AvataSDK\Models\OrderResultQuery;
use AvataSDK\Models\TransferQuery;
use AvataSDK\Utils\CommonUtil;

try {

    $config      = [
        'apiKey'    => "M212B0U781X3T0g4h1o9U4q3u77276K",
        'apiSecret' => "L222O0H7S1H3A044U1J9G4k3e7P2Y6I",
        'apiDomain' => "https://stage.apis.avata.bianjie.ai",
    ];
    $AvataClient = new AvataClient($config);
    //创建链账户
    $requestModel = new AccountCreate(['bodyParam' => ['name' => 'test', 'operation_id' => CommonUtil::getMillisecond(),]]);
    //查询链账户
    $requestModel = new AccountQuery([
        'queryParam' => [
            'name' => 'test',
            // 'account'      => 'iaa1g25sk98kla8nhv3fwsmct7mvv5k86zd30rzrfe',
            // 'operation_id' => 'operationid1658941811',
        ],
    ]);
    //查询链账户操作记录
    $requestModel = new AccountHistoryQuery(['queryParam' => ['account' => 'iaa1g25sk98kla8nhv3fwsmct7mvv5k86zd30rzrfe',]]);

    //上链交易结果查询
    $requestModel = new TransferQuery(['pathParam' => ['operation_id' => 'operationid1658941811',]]);

    //创建 NFT 类别
    $requestModel = new NFTClassCreate(['bodyParam' => ['id' => 'cangpinn']]);
    //查询 NFT 类别列表
    $requestModel = new NFTClassQuery(['queryParam' => []]);
    //查询 NFT 类别详情
    $requestModel = new NFTClassDetailQuery(['pathParam' => ['id' => 'cangpinn']]);
    //转让 NFT 类别
    $requestModel = new NFTClassTransfer([
        'pathParam' => ['class_id' => '', 'owner' => ''],
        'bodyParam' => [
            'recipient', //NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址
            'operation_id', //操作 ID
            'tag', //交易标签
        ],
    ]);

    //发行 NFT
    $requestModel = new NFTCreate([
        'pathParam' => ['class_id' => 'cangpinn'],
        'bodyParam' => [
            'name', //NFT 名称
            'uri', //链外数据链接
            'uri_hash', //链外数据 Hash
            'data', //自定义链上元数据
            'recipient', //链外数据 Hash
            'tag', //交易标签,
            'operation_id', //操作 ID
        ],
    ]);

    //转让 NFT
    $requestModel = new NFTTransfer([
        'pathParam' => [
            'class_id', //NFT 类别 ID
            'owner', //NFT 持有者地址，也是 Tx 签名者地址
            'nft_id', //NFT ID
        ],
        'bodyParam' => [
            'recipient', //NFT 接收者地址
            'operation_id', //操作 ID
            'tag', //交易标签
        ],
    ]);

    //编辑 NFT
    $requestModel = new NFTEdit([
        'pathParam' => [
            'class_id', //NFT 类别 ID
            'owner', //NFT 持有者地址，也是 Tx 签名者地址
            'nft_id', //NFT ID
        ],
        'bodyParam' => [
            'name', //NFT 名称
            'uri', //链外数据链接
            'data', //自定义链上元数据
            'tag', //交易标签,
            'operation_id',//操作 ID
        ],
    ]);
    //销毁NFT
    $requestModel = new NFTDelete([
        'pathParam' => [
            'class_id', //NFT 类别 ID
            'owner', //NFT 持有者地址，也是 Tx 签名者地址
            'nft_id', //NFT ID
        ],
        'bodyParam' => [
            'tag', //交易标签,
            'operation_id',//操作 ID
        ],
    ]);
    //查询 NFT
    $requestModel = new NFTQuery([
        'queryParam' => [
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
        ],
    ]);
    //查询 NFT 详情
    $requestModel = new NFTDetailQuery([
        'pathParam' => [
            'class_id', //NFT类别ID
            'nft_id', //NFT ID
        ],
    ]);
    //查询 NFT 操作记录
    $requestModel = new NFTHistoryQuery([
        'pathParam'  => [
            'class_id', //NFT类别ID
            'nft_id', //NFT ID
        ],
        'queryParam' => [
            'offset',//游标，默认为 0
            'limit',//每页记录数，默认为 10，上限为 50
            'signer',//Tx 签名者地址
            'tx_hash',//NFT 操作 Tx Hash
            'operation',//操作类型：mint / edit / transfer / burn
            'start_date',//NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
            'end_date',//NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
            'sort_by',//排序规则：DATE_ASC / DATE_DESC
        ],
    ]);

    //购买能量值/业务费
    $requestModel = new OrderBuy([
        'bodyParam' => [
            'account', //链账户地址
            'amount', //购买金额 ，只能购买整数元金额；单位：分
            'order_type', //充值类型：gas：能量值；business：业务费
            'order_id', //自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写
        ],
    ]);
    //查询能量值/业务费购买结果列表
    $requestModel = new OrderQuery([
        'bodyParam' => [
            'offset', //string 游标，默认为 0
            'limit', //string 每页记录数，默认为 10，上限为 50
            'start_date', //string 充值订单创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
            'end_date', //string 充值订单创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
            'sort_by', //string排序规则：DATE_ASC / DATE_DESC，默认为 DATE_DESC
            'status', //string 订单状态：success 充值成功 / failed 充值失败 / pending 正在充值
        ],
    ]);
    //查询能量值/业务费购买结果
    $requestModel = new OrderResultQuery([
        'pathParam' => [
            'order_id', //Order ID
        ],
    ]);

    $res = $AvataClient->execute($requestModel);

    dd($requestModel, $res);
    die;
} catch (Exception $exception) {
    var_export($exception);
}
