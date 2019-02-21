<?php

class Tribooacademy_Helloworld_Block_Hello extends Mage_Core_Block_Template{

    public function getMessage() {
        $message = "Hello world!!!!!";
        return $message;
    }

}