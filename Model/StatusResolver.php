<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Cleargo\Clearomni\Model;

use Magento\Sales\Api\Data\OrderInterface;

class StatusResolver extends \Magento\Sales\Model\Order\StatusResolver
{
    /**
     * @param OrderInterface $order
     * @param string $state
     * @return string
     */
    public function getOrderStatusByState(OrderInterface $order, $state)
    {
        $paymentMethodOrderStatus = $order->getPayment()->getMethodInstance()
            ->getConfigData('order_status');

        if($order->getPayment()->getMethod()=='adyen_cc'&&$state=='processing'){
            $connection = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection')->getConnection();
            $query=$connection->prepare('insert into cleargo_clearomni_api_log set request_url=?,request_body=?,response_body=?,response_code=?,`date`=?,`debug`=?');
            $query->bindValue(1,'getOrderStatusByState');
            $query->bindValue(2,'adyen_cc'.'processing_ready_to_pick');
            $query->bindValue(3,'adyen_cc'.'processing_ready_to_pick');
            $query->bindValue(4,'adyen_cc'.'processing_ready_to_pick');
            $query->bindValue(5,date('d-m-Y H:i:s'));
            $query->bindValue(6,json_encode(debug_backtrace()));
            $query->execute();
            return 'processing_ready_to_pick';
        }
        return array_key_exists($paymentMethodOrderStatus, $order->getConfig()->getStateStatuses($state))
            ? $paymentMethodOrderStatus
            : $order->getConfig()->getStateDefaultStatus($state);
    }
}
