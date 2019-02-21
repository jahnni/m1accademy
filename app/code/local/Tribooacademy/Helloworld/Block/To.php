<?php

class Tribooacademy_Helloworld_Block_To extends Mage_Core_Block_Template {

    public function getTo() {
        $id = $this->getRequest()->getParam('id',null);
        $helper = Mage::helper('academy');
        $to = $helper->getCustomerNameFromId($id);
        return $to;
    }

}