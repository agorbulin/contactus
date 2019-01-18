<?php

namespace Goral\ContactUs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * @package Goral\ContactUs\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'goral_contactus'
         */
        $table = $installer->getConnection()
                           ->newTable($installer->getTable('goral_contactus'))
                           ->addColumn(
                               'entity_id',
                               \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                               null,
                               ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                               'Entity ID'
                           )
                           ->addColumn(
                               'name',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                               64,
                               [],
                               'Name'
                           )
                           ->addColumn(
                               'email',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                               64,
                               [],
                               'Email'
                           )
                           ->addColumn(
                               'telephone',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                               15,
                               [],
                               'Telephone'
                           )
                           ->addColumn(
                               'comment',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                               500,
                               [],
                               'Text of contact comment'
                           )
                           ->addColumn(
                               'answer',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                               500,
                               [],
                               'Answer on contact comment'
                           )
                           ->addColumn(
                               'status',
                               \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                               null,
                               ['nullable' => false, 'default' => 0],
                               'Status'
                           )
                           ->addColumn(
                               'created_at',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                               null,
                               ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                               'Creation Time'
                           )
                           ->addColumn(
                               'updated_at',
                               \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                               null,
                               [
                                   'nullable' => false,
                                   'default'  => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE
                               ],
                               'Update Time'
                           )
                           ->addColumn(
                               'store_id',
                               \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                               null,
                               ['unsigned' => true, 'nullable' => false],
                               'Store ID'
                           )
                           ->addForeignKey(
                               $installer->getFkName(
                                   'goral_contactus',
                                   'store_id',
                                   'store',
                                   'store_id'
                               ),
                               'store_id',
                               $installer->getTable('store'),
                               'store_id',
                               \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                           )
                           ->setComment('Contact Us Table');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
