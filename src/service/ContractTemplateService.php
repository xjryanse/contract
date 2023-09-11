<?php

namespace xjryanse\contract\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\system\model\SystemFile;
use think\facade\Request;
use Exception;

/**
 * 合同模板
 */
class ContractTemplateService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelQueryTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\contract\\model\\ContractTemplate';

    /**
     * 获取公版合同
     * 
     */
    public static function getCommonFile($cate, $orderType): SystemFile {
        $con[] = ['cate', '=', $cate];
        $con[] = ['type', '=', 'common'];
        $con[] = ['order_type', '=', $orderType];
        $info = self::find($con);

        if (!$info) {
            throw new Exception('合同模板不存在' . $cate . '-' . $orderType);
        }
        return $info['file_id'];
    }

    /**
     * 获取公版合同
     */
    public static function getCommon($cate, $orderType) {
        $con[] = ['cate', '=', $cate];
        $con[] = ['type', '=', 'common'];
        $con[] = ['order_type', '=', $orderType];
        return self::find($con);
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
