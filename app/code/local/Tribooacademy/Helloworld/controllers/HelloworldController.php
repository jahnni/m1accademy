<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/02/19
 * Time: 17.17
 */
class Tribooacademy_Helloworld_HelloworldController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        var_dump($this->getLayout()->getUpdate()->getHandles());
        var_dump($this->getFullActionName());
        $this->loadLayout();
        $this->renderLayout();
    }

    public function toAction() {
        $id = $this->getRequest()->getParam('id',null);
        $helper = Mage::helper('academy');
        $to = $helper->getCustomerNameFromId($id);
        echo "Hello $to!";
    }



}