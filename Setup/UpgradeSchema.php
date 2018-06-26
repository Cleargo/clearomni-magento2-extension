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
        if (version_compare($context->getVersion(), "1.0.2", "<")) {
            //Your upgrade script
            $table_cleargo_clearomni_order = $setup->getConnection()->newTable($setup->getTable('cleargo_clearomni_api_log'));


            $table_cleargo_clearomni_order->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
                'Entity ID'
            );



            $table_cleargo_clearomni_order->addColumn(
                'request_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'request_url'
            );



            $table_cleargo_clearomni_order->addColumn(
                'request_body',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'request_body'
            );



            $table_cleargo_clearomni_order->addColumn(
                'response_body',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'response_body'
            );



            $table_cleargo_clearomni_order->addColumn(
                'response_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'response_code'
            );



            $table_cleargo_clearomni_order->addColumn(
                'date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'date'
            );



            $table_cleargo_clearomni_order->addColumn(
                'debug',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [],
                'Debug stack trace'
            );



            $setup->getConnection()->createTable($table_cleargo_clearomni_order);
        }
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'qty_clearomni_ready_to_pick',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'comment' => 'qty_clearomni_reserved',
                    'precision' => 10,'scale' => 4,'default' => '0'
                ]
            );
        }
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'qty_clearomni_still_considering',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'comment' => 'qty_clearomni_still_considering',
                    'precision' => 10,'scale' => 4,'default' => '0'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'qty_clearomni_not_interested',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'comment' => 'qty_clearomni_not_interested',
                    'precision' => 10,'scale' => 4,'default' => '0'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'qty_clearomni_no_show',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'comment' => 'qty_clearomni_no_show',
                    'precision' => 10,'scale' => 4,'default' => '0'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'qty_clearomni_closed',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'comment' => 'qty_clearomni_closed',
                    'precision' => 10,'scale' => 4,'default' => '0'
                ]
            );
        }
        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_order'),
                'visiting_date',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'visiting_date'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_order'),
                'visiting_hour',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'visiting_hour'
                ]
            );
        }
        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_order'),
                'item_data',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'data in json'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('cleargo_clearomni_orderitem'),
                'item_data',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'data in json',
                ]
            );
        }
        $setup->endSetup();
    }
}
