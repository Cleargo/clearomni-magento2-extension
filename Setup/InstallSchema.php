<?php


namespace Cleargo\Clearomni\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_cleargo_clearomni_orderitem = $setup->getConnection()->newTable($setup->getTable('cleargo_clearomni_orderitem'));

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'order_item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Reference to order item id'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'order_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Order Id'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_reserved',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_reserved'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_to_transfer',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_to_transfer'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_cancelled',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_cancelled'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_completed',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_completed'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_refunded',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_refunded'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_exchange_success',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_exchange_success'
        );
        

        
        $table_cleargo_clearomni_orderitem->addColumn(
            'qty_clearomni_exchange_rejected',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['precision' => 10,'scale' => 4,'default' => '0'],
            'qty_clearomni_exchange_rejected'
        );
        

        $setup->getConnection()->createTable($table_cleargo_clearomni_orderitem);

        $setup->endSetup();
    }
}
