<?php

class Triboo_Sales_Model_To_Accademy_Order extends Mage_Core_Model_Abstract{

    const FILENAME_PATTERN = "ACCADEMY_%s.csv";

    private $_file;
    private $_orderData;


    /* @var $order Mage_Sales_Model_Order*/
    public function populate($order)
    {
        $this->_orderData = Mage::getModel('triboo_sales/to_accademy_order_data');
        $this->_orderData->setData('increment_id', $order->getIncrementId());

        return $this;
    }

    public function save(){
        $this->_prepareCsvFile();
        $this->_persist();
        return $this;
    }

    private function _prepareCsvFile() {

        $fileName = sprintf(self::FILENAME_PATTERN,Mage::getModel('core/date')->date('YmdHis')."_".$nmp);
        $this->_file = Mage::getModel('tbflow/out')
            ->setName($fileName)
            ->setFlow('triboo_sales/to_accademy_order_data')
            ->setType('file')
            ->setChannel('triboo_sales/to')
            ->setStatus('preparing')
            ->save();
    }

    private function _persist() {
        $transaction = Mage::getModel('core/resource_transaction');
        $this->_orderData->setMetaFile($this->_file->getId());
        $transaction->addObject($this->_orderData);
        $this->_file->setStatus('prepared');
        $transaction->addObject($this->_file);
        $transaction->save();
    }

}