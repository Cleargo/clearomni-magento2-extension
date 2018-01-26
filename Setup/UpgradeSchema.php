<?php


namespace Cleargo\Clearomni\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), "1.0.1", "<")) {
        //Your upgrade script
            $table_cleargo_clearomni_order = $setup->getConnection()->newTable($setup->getTable('cleargo_clearomni_order'));


            $table_cleargo_clearomni_order->addColumn(
                'order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
                'Entity ID'
            );



            $table_cleargo_clearomni_order->addColumn(
                'staff_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'staff_code'
            );



            $table_cleargo_clearomni_order->addColumn(
                'clearomni_remarks',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'clearomni_remarks'
            );



            $table_cleargo_clearomni_order->addColumn(
                'pickup_store',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'pickup_store'
            );



            $table_cleargo_clearomni_order->addColumn(
                'pickup_store_label',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'pickup_store_label'
            );



            $table_cleargo_clearomni_order->addColumn(
                'pickup_store_clearomni_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'pickup_store_clearomni_id'
            );
            $table_cleargo_clearomni_order->addColumn(
                'magento_order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'magento_order_id'
            );



            $setup->getConnection()->createTable($table_cleargo_clearomni_order);
        }
        $setup->endSetup();
    }
}
