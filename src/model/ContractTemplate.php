<?php
namespace xjryanse\contract\model;

/**
 * 合同模板
 */
class ContractTemplate extends Base
{
    public function setFileIdAttr($value) {
        return self::setImgVal($value);
    }
    public function getFileIdAttr($value) {
        return self::getImgVal($value,false);
    }
}