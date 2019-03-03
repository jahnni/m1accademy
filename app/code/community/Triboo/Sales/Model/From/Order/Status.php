<?php
/**
 * Created by PhpStorm.
 * User: jahnni
 * Date: 03/03/19
 * Time: 22.09
 */ 
class Triboo_Sales_Model_From_Order_Status extends Tbuy_Flow_Model_From_Abstract
{

    protected function _construct()
    {
        $this->_init('triboo_sales/from_order_status');
    }

    public function process() {
        //loadorder
        $order = Mage::getModel('sales/order')->loadByIncrementId($this->getIncrementId());
        if(!$order->getId()){
            Mage::throwException("Order with id ".$this->getIncrementId()." not found");
        }
        try{
            $order->addStatusHistoryComment("Updated via flow",$this->getStatus())->save();
            $order->save();
        }catch (Exception $e){
            Mage::logException($e);
            return false;
        }

        return true;
    }

}