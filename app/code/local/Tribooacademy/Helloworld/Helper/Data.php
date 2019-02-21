<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/02/19
 * Time: 17.12
 */ 
class Tribooacademy_Helloworld_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getCustomerNameFromId($id) {
        $name = '';
        if($id) {
            $customer = Mage::getModel('customer/customer')->load($id);
            if($customer->getId()) {
                $name = $customer->getName();
            }
        }
        return $name;
    }

}