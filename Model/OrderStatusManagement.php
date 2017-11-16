<?php


namespace Cleargo\Clearomni\Model;

class OrderStatusManagement
{

    /**
     * {@inheritdoc}
     */
    public function getOrderStatus()
    {
    	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $select = $connection->select()
                ->from(
                    ['sos' => 'sales_order_status'],
                    ['status', 'label']
                )
                ;

        $data = $connection->fetchAll($select);

        return $data;
        // return 'hello api GET return the $param ' . $param;
    }
}
