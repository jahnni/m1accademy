<?php
/**
 * Created by PhpStorm.
 * User: jahnni
 * Date: 03/03/19
 * Time: 22.09
 */ 
class Triboo_Sales_Model_Resource_From_Order_Status_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('triboo_sales/from_order_status');
    }

}