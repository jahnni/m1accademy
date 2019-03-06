<?php

class Triboo_Sales_Model_Processor extends Tbuy_Flow_Model_Processor_Abstract {

    public function processAccademing(){
        $this->processAccademing();
    }

    protected function _processAccademing(){
        $accademingOrdersQueue = Mage::getModel('tbflow/queue')->getWaitingQueueCollection(Triboo_Sales_Helper_Data::QUEUE_FLOW_TYPE);
        if (!count($accademingOrdersQueue)) {
            return false;
        }
        Mage::getSingleton('core/resource_iterator')->walk($accademingOrdersQueue->getSelect(), array(array($this, 'processAccademyOrder')));
    }

    public function processAccademyOrder($accademyOrderQueue){
        try{
            $accademyOrderQueue = Mage::getModel('tbflow/queue')->load($accademyOrderQueue['row']['queue_id']);
            /* @var $order Mage_Sales_Model_Order*/
            $order = $accademyOrderQueue->getOrder();

            Mage::getModel('triboo_sales/to_accademy_order')
                ->populate($order)
                ->save();
            $accademyOrderQueue->setProcessed("Accademy info sent")->save();
        }catch (Exception $e){
            //TODO eventually delete shipment and flow out
            Mage::throwException($e);
        }
    }

    private function _sendShipmentInfoToPartner(Legami_Shipment_Model_Shipment_Info_Abstract $shipmentInfo){

        Mage::getModel('legami_shipment/to_shipment')
            ->populate($shipmentInfo)
            ->save();
        $this->_sendShipmentLabel($shipmentInfo);
    }

    private function _sendShipmentLabel(Legami_Shipment_Model_Shipment_Info_Abstract $shipmentInfo){
        $cleanedNMP = preg_replace('/[^A-Za-z0-9\-]/', '_',$shipmentInfo->getNMP());
        $shipmentLabelFileName = sprintf(self::SHIPMENT_LABEL_NAME,$cleanedNMP,$shipmentInfo->getBarcodeSuffix());
        $channel = Mage::getStoreConfig('tbflow/channels/legami_shipment/to_shipment_label');
        $filepath = Mage::getConfig()->getVarDir().'/'.$channel['localbasedir'].'/'.$channel['dir'].'/'.$shipmentLabelFileName;
        file_put_contents($filepath,$shipmentInfo->getBarcodeFile());
        Mage::getModel('tbflow/out')
            ->setName($shipmentLabelFileName)
            ->setFlow('legami_shipment/to_shipment_label')
            ->setType('file')
            ->setChannel('legami_shipment/to')
            ->setStatus('written')
            ->save();
    }



}
