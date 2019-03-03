<?php
/**
 * Created by PhpStorm.
 * User: jahnni
 * Date: 03/03/19
 * Time: 21.57
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$conn = $installer->getConnection();

$fromOrderStatusTable = $conn->newTable($installer->getTable('triboo_sales/from_order_status'))
    ->addColumn(
        'increment_id',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        50,
        [
            'nullable' => false,
        ],
        'increment_id'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        32,
        [
            'nullable' => false,
        ],
        'Order status'
    )
    ->addColumn(
        'meta_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
        ],
        'id'
    )
    ->addColumn(
        'meta_ref_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
        ],
        'meta_ref_id'
    )
    ->addColumn(
        'meta_file',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
        ],
        'meta_file'
    )
    ->addColumn(
        'meta_processed',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        null,
        [
            'nullable' => false,
            'default' => 0
        ],
        'meta_processed'
    )
    ->addColumn(
        'meta_insert_time',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [],
        'meta_insert_time'
    )
    ->addColumn(
        'meta_process_time',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [],
        'meta_process_time'
    )
    ->addColumn(
        'meta_hash',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        [
            'nullable' => false,
        ],
        'no comment')
    ->addForeignKey(
        $installer->getFkName(
            'triboo_sales/from_order_status',
            'meta_file',
            'tbflow/in',
            'id'
        ),
        'meta_file', $installer->getTable('tbflow/in'), 'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Triboo sales from order status');


if ($installer->tableExists($fromOrderStatusTable->getName())) {
    $installer->getConnection()->dropTable($fromOrderStatusTable->getName());
}

$installer->getConnection()->createTable($fromOrderStatusTable);

$installer->endSetup();