<?php
namespace xjryanse\contract\model;

/**
 * 
 */
class Contract extends Base
{
    public function setContractWordAttr( $value )
    {
        return self::setImgVal($value);
    }    
    public function setContractPdfAttr( $value )
    {
        return self::setImgVal($value);
    }    
    public function setContractSealAttr( $value )
    {
        return self::setImgVal($value);
    }
    
    public function getContractWordAttr( $value )
    {
        return self::getImgVal($value);
    }    
    public function getContractPdfAttr( $value )
    {
        return self::getImgVal($value);
    }    
    public function getContractSealAttr( $value )
    {
        return self::getImgVal($value);
    }
}