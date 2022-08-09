<?php

namespace AvataSDK\Test;

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

class ExampleCase
{
    public $AvataClient;

    public function __construct()
    {
        $config            = [
            'apiKey'    => "M212B0U781X3T0g4h1o9U4q3u77276K",
            'apiSecret' => "L222O0H7S1H3A044U1J9G4k3e7P2Y6I",
            'apiDomain' => "https://stage.apis.avata.bianjie.ai",
        ];
        $this->AvataClient = new AvataClient($config);
    }

    /**
     * 创建链账户
     *
     * @return void
     */
    public function AccountCreate()
    {
        $requestModel = new AccountCreate([
            'bodyParam' => [
                'name'         => 'test',
                'operation_id' => CommonUtil::getMillisecond(),
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询链账户
     *
     * @return void
     */
    public function AccountQuery()
    {
        $requestModel = new AccountQuery([
            'queryParam' => [
                'name'         => 'test', //链账户名称，支持模糊查询
                'account'      => 'iaa1g25sk98kla8nhv3fwsmct7mvv5k86zd30rzrfe', //链账户地址
                'operation_id' => 'operationid1658941811',//操作ID
                'offset'       => '', //游标，默认为 0
                'limit'        => '', //每页记录数，默认为 10，上限为 50
                'start_date'   => '', //创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'     => '', //创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'      => '', //排序规则：DATE_ASC / DATE_DESC
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询链账户操作记录
     *
     * @return void
     */
    public function AccountHistoryQuery()
    {
        $requestModel = new AccountHistoryQuery([
            'queryParam' => [
                'account'    => 'iaa1g25sk98kla8nhv3fwsmct7mvv5k86zd30rzrfe', //链账户地址
                'offset'     => '', //游标，默认为 0
                'limit'      => '', //每页记录数，默认为 10，上限为 50
                'module'     => '', //功能模块：account / nft
                // 操作类型，仅 module 不为空时有效，默认为 ”all“;
                // module = account 时可选：add_gas;
                // module = nft 时可选：transfer_class / mint / edit / transfer / burn / issue_class
                'operation'  => '',
                'start_date' => '', //创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'   => '', //创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'    => '', //排序规则：DATE_ASC / DATE_DESC
                'tx_hash'    => '', //Tx Hash
            ],
        ]);

        $res = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 上链交易结果查询
     *
     * @return void
     */
    public function TransferQuery()
    {
        $requestModel = new TransferQuery([
            'pathParam' => [
                'operation_id' => 'operationid1658941811', //操作ID
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 创建NFT类别
     *
     * @return void
     */
    public function NFTClassCreate()
    {
        $requestModel = new NFTClassCreate([
            'bodyParam' => [
                'operation_id' => '',//操作ID
                'name'         => '', //链账户名称，支持 1-20 位汉字、大小写字母及数字组成的字符串
                'symbol'       => '', //标识
                'description'  => '', //描述
                'uri'          => '', //链外数据链接
                'uri_hash'     => '', //链外数据 Hash
                'data'         => '', //自定义链上元数据
                'owner'        => '', //NFT 类别权属者地址，支持任一文昌链合法链账户地址
                //交易标签, 自定义 key：支持大小写英文字母和汉字和数字，长度6-12位，自定义 value：长度限制在64位字符，支持大小写字母和数字
                'tag'          => [
                    'key1' => '', //链账户地址
                    'key2' => '', //链账户名称
                    'key3' => '', //Gas 余额
                ],
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询NFT类别列表
     *
     * @return void
     */
    public function NFTClassQuery()
    {
        $requestModel = new NFTClassQuery([
            'queryParam' => [
                'offset'     => '', //游标，默认为 0
                'limit'      => '', //每页记录数，默认为 10，上限为 50
                'id'         => '', //NFT 类别 ID
                'name'       => '', //NFT 类别名称，支持模糊查询
                'owner'      => '', //NFT 类别权属者地址
                'tx_hash'    => '', //创建 NFT 类别的 Tx Hash
                'start_date' => '', //NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'   => '', //NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'    => '', //排序规则：DATE_ASC / DATE_DESC
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询NFT类别详情
     *
     * @return void
     */
    public function NFTClassDetailQuery()
    {
        $requestModel = new NFTClassDetailQuery([
            'pathParam' => [
                'id' => 'cangpinn',//NFT类别ID
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 转让NFT类别
     *
     * @return void
     */
    public function NFTClassTransfer()
    {
        $requestModel = new NFTClassTransfer([
            'pathParam' => [
                'class_id' => '',//NFT类别ID
                'owner'    => '',//NFT类别权属者地址
            ],
            'bodyParam' => [
                'recipient'    => '', //NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址
                'operation_id' => '', //操作 ID
                'tag'          => '', //交易标签
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 发行NFT
     *
     * @return void
     */
    public function NFTCreate()
    {
        $requestModel = new NFTCreate([
            'pathParam' => [
                'class_id' => 'cangpinn',//NFT类别ID
            ],
            'bodyParam' => [
                'operation_id' => '', //操作 ID
                'name'         => '', //NFT 名称
                'uri'          => '', //链外数据链接
                'uri_hash'     => '', //链外数据 Hash
                'data'         => '', //自定义链上元数据
                'recipient'    => '', //链外数据 Hash
                'tag'          => '', //交易标签
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 转让NFT
     *
     * @return void
     */
    public function NFTTransfer()
    {
        $requestModel = new NFTTransfer([
            'pathParam' => [
                'class_id' => '', //NFT类别ID
                'owner'    => '', //NFT持有者地址，也是 Tx 签名者地址
                'nft_id'   => '', //NFT ID
            ],
            'bodyParam' => [
                'operation_id' => '', //操作 ID
                'recipient'    => '', //NFT 接收者地址
                'tag'          => '', //交易标签
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 编辑NFT
     *
     * @return void
     */
    public function NFTEdit()
    {
        $requestModel = new NFTEdit([
            'pathParam' => [
                'class_id' => '', //NFT类别ID
                'owner'    => '', //NFT持有者地址，也是 Tx 签名者地址
                'nft_id'   => '', //NFT ID
            ],
            'bodyParam' => [
                'operation_id' => '',//操作 ID
                'name'         => '', //NFT 名称
                'uri'          => '', //链外数据链接
                'data'         => '', //自定义链上元数据
                'tag'          => '', //交易标签,
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 销毁NFT
     *
     * @return void
     */
    public function NFTDelete()
    {
        $requestModel = new NFTDelete([
            'pathParam' => [
                'class_id' => '', //NFT类别ID
                'owner'    => '', //NFT持有者地址，也是 Tx 签名者地址
                'nft_id'   => '', //NFT ID
            ],
            'bodyParam' => [
                'operation_id' => '',//操作 ID
                'tag'          => '', //交易标签,
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询NFT
     *
     * @return void
     */
    public function NFTQuery()
    {
        $requestModel = new NFTQuery([
            'queryParam' => [
                'offset'     => '', //游标，默认为 0
                'limit'      => '', //每页记录数，默认为 10，上限为 50
                'id'         => '', //NFT ID
                'class_id'   => '', //NFT 类别 ID
                'owner'      => '', //NFT 持有者地址
                'tx_hash'    => '', //创建 NFT 的 Tx Hash
                'start_date' => '', //NFT 创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'   => '', //NFT 创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'    => '', //排序规则：ID_ASC / ID_DESC / DATE_ASC / DATE_DESC
                'status'     => '', //NFT 状态：active / burned，默认为 active
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询NFT详情
     *
     * @return void
     */
    public function NFTDetailQuery()
    {
        $requestModel = new NFTDetailQuery([
            'pathParam' => [
                'class_id' => '', //NFT类别ID
                'nft_id'   => '', //NFT ID
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询NFT操作记录
     *
     * @return void
     */
    public function NFTHistoryQuery()
    {
        $requestModel = new NFTHistoryQuery([
            'pathParam'  => [
                'class_id' => '', //NFT类别ID
                'nft_id'   => '', //NFT ID
            ],
            'queryParam' => [
                'offset'     => '',//游标，默认为 0
                'limit'      => '',//每页记录数，默认为 10，上限为 50
                'signer'     => '',//Tx 签名者地址
                'tx_hash'    => '',//NFT 操作 Tx Hash
                'operation'  => '',//操作类型：mint / edit / transfer / burn
                'start_date' => '',//NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'   => '',//NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'    => '',//排序规则：DATE_ASC / DATE_DESC
            ],
        ]);

        $res = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 购买能量值/业务费
     *
     * @return void
     */
    public function OrderBuy()
    {
        $requestModel = new OrderBuy([
            'bodyParam' => [
                'account'    => '', //链账户地址
                'amount'     => '', //购买金额 ，只能购买整数元金额；单位：分
                'order_type' => '', //充值类型：gas：能量值；business：业务费
                'order_id'   => '', //自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写
            ],
        ]);

        $res = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询能量值/业务费购买结果列表
     *
     * @return void
     */
    public function OrderQuery()
    {
        $requestModel = new OrderQuery([
            'bodyParam' => [
                'offset'     => '', //string 游标，默认为 0
                'limit'      => '', //string 每页记录数，默认为 10，上限为 50
                'start_date' => '', //string 充值订单创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
                'end_date'   => '', //string 充值订单创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
                'sort_by'    => '', //string排序规则：DATE_ASC / DATE_DESC，默认为 DATE_DESC
                'status'     => '', //string 订单状态：success 充值成功 / failed 充值失败 / pending 正在充值
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }

    /**
     * 查询能量值/业务费购买结果
     *
     * @return void
     */
    public function OrderResultQuery()
    {
        $requestModel = new OrderResultQuery([
            'pathParam' => [
                'order_id' => '', //Order ID
            ],
        ]);
        $res          = $this->AvataClient->execute($requestModel);
        dd($requestModel, $res);
    }
}
