<?php


namespace Cleargo\Clearomni\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        //Your install script
        $connection=$setup->getConnection();
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'closed_exchange_success\', \'Exchange Success\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'closed_refund_success\', \'Refund Success\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'complete_exchange_acknowledged\', \'Exchange Acknowledged\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'complete_exchange_rejected\', \'Complete Exchange Rejected\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'complete_exchange_requested\', \'Exchange Requested\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'processing_canceled\', \'Canceled\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'processing_expired\', \'Expired\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'processing_pending_transfer\', \'Pending transfer\');');
        $connection->query('INSERT INTO `sales_order_status` (`status`, `label`) VALUES (\'processing_ready_to_pick\', \'Ready To Pick\');');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'closed_exchange_success\', \'closed\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'closed_refund_success\', \'closed\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'complete_exchange_requested\', \'complete\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'complete_exchange_rejected\', \'complete\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'complete_exchange_acknowledged\', \'complete\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'processing_pending_transfer\', \'processing\', 0, 0);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'processing_expired\', \'processing\', 0, 0);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'processing_canceled\', \'processing\', 0, 1);');
        $connection->query('INSERT INTO `sales_order_status_state` (`status`, `state`, `is_default`, `visible_on_front`) VALUES (\'processing_ready_to_pick\', \'processing\', 0, 0);');
    }
}
