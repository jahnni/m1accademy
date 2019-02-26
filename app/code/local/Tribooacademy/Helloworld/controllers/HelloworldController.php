<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/02/19
 * Time: 17.17
 */
class Tribooacademy_Helloworld_HelloworldController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function toAction() {
        $to = $this->getRequest()->getParam('id',null);
        Mage::register('triboo_helloworld_to',$to);

        $this->loadLayout();
        $this->renderLayout();

        Mage::unregister('triboo_helloworld_to');
    }



}