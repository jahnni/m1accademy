<?php
/**
 * Created by PhpStorm.
 * User: giovanni.sposito
 * Date: 06/03/19
 * Time: 16.02
 */ 
class Triboo_Sales_Model_Resource_To_Accademy_Order_Data_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('triboo_sales/to_accademy_order_data');
    }

}