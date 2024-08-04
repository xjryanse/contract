<?php

namespace xjryanse\contract\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\order\service\OrderService;
use xjryanse\logic\Arrays;
/**
 * 
 */
class ContractService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelRamTrait;
    use \xjryanse\traits\MainModelCacheTrait;
    use \xjryanse\traits\MainModelCheckTrait;
    use \xjryanse\traits\MainModelGroupTrait;
    use \xjryanse\traits\MainModelQueryTrait;


    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\contract\\model\\Contract';

    use \xjryanse\contract\service\index\FieldTraits;
    /**
     * 额外详情信息
     */
    public static function extraDetail(&$item, $uuid) {
        // 20240520:废弃无用方法
        self::stopUse(__METHOD__);

        if (!$item) {
            return false;
        }
        self::commExtraDetail($item, $uuid);
        //合同订单:逗号分隔
        $con[] = ['contract_id', '=', $uuid];
        $orderIds = ContractOrderService::mainModel()->where($con)->column('order_id');
        $item->SCorder_id = count($orderIds);         //订单数量
        $item->Dorder_id = implode(',', $orderIds);  //订单逗号分隔
        return $item;
    }

    /**
     * 带子表的添加
     * @param type $groupType   分组类型
     * @param type $orderIds
     * @param array $data
     */
    public static function addWithSub($contractType, $orderIds, $data = []) {
        $data['contract_type'] = $contractType;
        $res = self::save($data);
        foreach ($orderIds as $orderId) {
            $tmpData = [];
            $tmpData['contract_id'] = $res['id'];
            $tmpData['order_id'] = $orderId;
            ContractOrderService::save($tmpData);
        }
        return $res;
    }

    /**
     * 
     * @param type $data
     * @param type $uuid
     * @return type
     */
    public static function extraAfterUpdate(&$data, $uuid) {
        //审核不通过，更新订单记录状态
        if (isset($data['audit_status'])) {
            $contractFieldValue = $data['audit_status'] == 2 ? 0 : 1;

            $info = self::getInstance($uuid)->get(0);
            $contractType = Arrays::value($info, 'contract_type');
            $contractField = 'is_contract_' . $contractType;
            $con[] = ['contract_id', '=', $uuid];
            $orderIds = ContractOrderService::mainModel()->where($con)->column('order_id');
            //更新订单id
            foreach ($orderIds as $orderId) {
                if (OrderService::mainModel()->hasField($contractField) && OrderService::getInstance($orderId)->get()) {
                    OrderService::getInstance($orderId)->update([$contractField => $contractFieldValue]);
                }
            }
        }
    }
    /**
     * 
     * @param type $customerId
     * @param type $time
     * @param type $con
     * @return type
     */
    public static function matchIdsByCustomerAndTime($customerId, $time, $con = []){
        $con[] = ['customer_id','=',$customerId];
        $con[] = ['end_time','>=',$time];
        $con[] = ['start_time','<=',$time];

        return self::where($con)->column('id');
    }


}
