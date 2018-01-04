<?php


namespace Cleargo\Clearomni\Model;

use Magento\Sales\Api\OrderManagementInterface;

class OrderManagement
{
    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var OrderManagementInterface
     */
    protected $orderManagement;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    protected $connection;

    /**
     * @var \Magento\Sales\Model\Order\CreditmemoFactory
     */
    protected $creditmemoFactory;
    /**
     * @var \Magento\Sales\Model\Service\CreditmemoService
     */
    protected $creditmemoService;

    protected $convertOrder;
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Api\OrderManagementInterface $orderManagement,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResourceConnection $connection,
        \Magento\Sales\Model\Order\CreditmemoFactory $creditmemoFactory,
        \Magento\Sales\Model\Service\CreditmemoService $creditmemoService,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Model\Convert\Order $convertOrder
    )
    {
        $this->orderRepository = $orderRepository;
        $this->storeManager = $storeManager;
        $this->orderManagement = $orderManagement;
        $this->connection = $connection->getConnection();
        $this->creditmemoFactory = $creditmemoFactory;
        $this->creditmemoService = $creditmemoService;
        $this->orderFactory = $orderFactory;
        $this->convertOrder = $convertOrder;
    }

    /**
     * {@inheritdoc}
     */
    public function postOrder($param)
    {
        return 'hello api POST return the $param ' . $param;
    }

    public function updateOrder($param)
    {
        /**
         * param:{"order_id":"","status":""}
         */
        /**
         * @var $order \Magento\Sales\Model\Order
         */
//        $param = json_decode($param);
        $result = [
            'result' => false,
            'data' => '',
            'message' => ''
        ];
        $orderId = $param['order_id'];
        //Get Order
        try {
            $order = $this->orderRepository->get($orderId);
            $order = $this->orderFactory->create()->load($orderId);
        } catch (\Exception $e) {
            $result['result'] = false;
            $result['message'] = $e->getMessage();
            return json_encode($result);
        }
        $status = $param['status'];
        $state = $this->getOrderState($status);
        $statusExist = $this->checkStatusExist($status);
        if ($statusExist <= 0) {
            $result['result'] = false;
            $result['message'] = 'Order Status not exist';
            return json_encode($result);
        }
        if ($state == $order->getState()) {
            if ($statusExist > 0) {
                $order->addStatusHistoryComment('Order Status is updated to ' . $status . ' by api', $status);
                $result['result'] = true;
                $result['message'] = 'Order Status is updated to ' . $status;
            } else {
                $result['result'] = false;
                $result['message'] = 'Order Status not exist';
            }
        } else {
            $result = $this->handleOrder($order, $status);
        }
        $order->save();
//        $this->orderRepository->save($order);
        return json_encode($result);
    }

    protected function handleOrder($order, $toStatus)
    {
        /**
         * @var $order \Magento\Sales\Model\Order
         */
        $result = [
            'result' => true,
            'data' => '',
            'message' => ''
        ];
        $toState = $this->getOrderState($toStatus);
        $result['data'] = [$toState, $toStatus];
        if ($toState == 'canceled') {
            if (($order->getState() == 'new' || $order->getState() == 'processing') && $order->hasInvoices() == false) {
                $result['result'] = $this->orderManagement->cancel($order->getId());
                $order->setState('canceled');
                $order->addStatusHistoryComment("Order Canceled by api", $toStatus);
                $order->setStatus('canceled');
                $result['message'] = 'Order Canceled';
                return $result;
            } else {
                $statusExist = $this->checkStatusExist($toStatus);
                if ($statusExist > 0) {
                    $order->addStatusHistoryComment('Order Canceled by api', $toStatus);
                } else {
                    $result['result'] = false;
                    $result['message'] = $order->getState() . '_' . $toStatus . " does not exist";
                    return $result;
                }
            }
        }
        if ($toState == 'closed') {
            if ($order->canCreditmemo()) {
                $creditmemo = $this->creditmemoFactory->createByOrder($order);
                $this->creditmemoService->refund($creditmemo);
                $order->addStatusHistoryComment('Credit memo created by api and change status to ' . $toStatus, $toStatus);
                $result['result'] = true;
                $result['message'] = 'Credit memo created by api and change status to ' . $toStatus;
                return $result;
            } else {
                $result['result'] = false;
                $result['message'] = 'Can not create creditmemo';
                return $result;
            }
        }
        if ($toState == 'complete') {
            if ($order->canShip()) {
                $shipment = $this->convertOrder->toShipment($order);

                foreach ($order->getAllItems() AS $orderItem) {
                    // Check if order item has qty to ship or is virtual
                    if (!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()) {
                        continue;
                    }
                    $qtyShipped = $orderItem->getQtyToShip();
                    // Create shipment item with qty
                    $shipmentItem = $this->convertOrder->itemToShipmentItem($orderItem)->setQty($qtyShipped);
                    // Add shipment item to shipment
                    $shipment->addItem($shipmentItem);
                }
                $shipment->register();

                $order->addStatusHistoryComment('Shipment created by api and change status to ' . $toStatus, $toStatus);
                $result['result'] = true;
                $result['message'] = 'Shipment created by api and change status to ' . $toStatus;
                return $result;
            } else {
                $result['result'] = false;
                $result['message'] = 'Can not create shipment';
                return $result;
            }
        }
    }

    protected function getOrderState($status)
    {
        $query = $this->connection->prepare('select state from sales_order_status_state where status=?');
        $query->bindValue(1, $status);
        $query->execute();
        $result = $query->fetch();
        if (!empty($result)) {
            return $result['state'];
        }
        return '';
    }

    protected function checkStatusExist($status)
    {
        $query = $this->connection->prepare('select count(*) as "total" from sales_order_status_state where status=?');
        $query->bindValue(1, $status);
        $query->execute();
        $result = $query->fetch();
        return $result['total'];
    }
}
