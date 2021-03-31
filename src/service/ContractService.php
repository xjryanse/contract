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

    protected static $mainModel;
    protected static $mainModelClass = '\\app\\contract\\model\\Contract';

    /**
     * 额外详情信息
     */
    public static function extraDetail(&$item, $uuid) {
        if(!$item){ return false;}
        self::commExtraDetail($item, $uuid);
        //合同订单:逗号分隔
        $con[]      = ['contract_id','=',$uuid]; 
        $orderIds   = ContractOrderService::mainModel()->where( $con )->column('order_id');
        $item->SCorder_id   = count($orderIds);         //订单数量
        $item->Dorder_id    = implode(',', $orderIds);  //订单逗号分隔
        return $item;
    }
    
    /**
     * 带子表的添加
     * @param type $groupType   分组类型
     * @param type $orderIds
     * @param array $data
     */
    public static function addWithSub( $contractType, $orderIds, $data=[] )
    {
        $data['contract_type'] = $contractType;
        $res = self::save($data);
        foreach( $orderIds as $orderId ){
            $tmpData                = [];
            $tmpData['contract_id']    = $res['id'];
            $tmpData['order_id']    = $orderId;
            ContractOrderService::save( $tmpData );
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
        if(isset( $data['audit_status'])){
            $contractFieldValue = $data['audit_status'] == 2 ? 0 : 1;

            $info = self::getInstance( $uuid )->get(0);
            $contractType   = Arrays::value($info,'contract_type');
            $contractField  = 'is_contract_'.$contractType;
            $con[]          = ['contract_id','=',$uuid];
            $orderIds       = ContractOrderService::mainModel()->where( $con )->column('order_id');
            //更新订单id
            foreach( $orderIds as $orderId ){
                if( OrderService::mainModel()->hasField( $contractField ) ){
                    OrderService::getInstance( $orderId )->update( [$contractField =>$contractFieldValue] );
                }
            }
        }
    }
    /**
     *
     */
    public function fAppId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fCompanyId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 合同名称
     */
    public function fContractName() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 合同编号
     */
    public function fContractNo() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * pdf版本
     */
    public function fContractPdf() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 合同类型
     */
    public function fContractType() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * word版本
     */
    public function fContractWord() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建时间
     */
    public function fCreateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建者，user表
     */
    public function fCreater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 有使用(0否,1是)
     */
    public function fHasUsed() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未删，1：已删）
     */
    public function fIsDelete() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未锁，1：已锁）
     */
    public function fIsLock() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 备注
     */
    public function fRemark() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 排序
     */
    public function fSort() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 状态(0禁用,1启用)
     */
    public function fStatus() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新时间
     */
    public function fUpdateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新者，user表
     */
    public function fUpdater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

}
