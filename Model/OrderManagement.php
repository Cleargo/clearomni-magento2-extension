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

    /**
     * @var \Magento\Rma\Model\Rma\RmaDataMapper
     */
    protected $rmaDataMapper;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    protected $result;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Api\OrderManagementInterface $orderManagement,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResourceConnection $connection,
        \Magento\Sales\Model\Order\CreditmemoFactory $creditmemoFactory,
        \Magento\Sales\Model\Service\CreditmemoService $creditmemoService,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Model\Convert\Order $convertOrder,
        \Magento\Rma\Model\Rma\RmaDataMapper $rmaDataMapper,
        \Magento\Framework\ObjectManagerInterface $objectManagerInterface,
        \Cleargo\Clearomni\Api\Data\ApiResultInterface $apiResult
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
        $this->rmaDataMapper = $rmaDataMapper;
        $this->_objectManager = $objectManagerInterface;
        $this->result=$apiResult;
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
            return $this->setResult($result);
        }
        $status = $param['status'];
        $state = $this->getOrderState($status);
        $statusExist = $this->checkStatusExist($status);
        if ($statusExist <= 0) {
            $result['result'] = false;
            $result['message'] = 'Order Status not exist';
            return $this->setResult($result);
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
        return $this->setResult($result);
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
                return ($result);
            } else {
                $statusExist = $this->checkStatusExist($toStatus);
                if ($statusExist > 0) {
                    $order->addStatusHistoryComment('Order Canceled by api', $toStatus);
                } else {
                    $result['result'] = false;
                    $result['message'] = $order->getState() . '_' . $toStatus . " does not exist";
                    return ($result);
                }
            }
        }
        if ($toState == 'closed') {
            if ($order->getState() == 'complete') {//create rma if order state is from complete to closed
                /** @var $model \Magento\Rma\Model\Rma */
                try {
                    $model = $this->_initModel($order);
                    $item = [];
                    foreach ($order->getAllVisibleItems() as $key => $value) {
                        $item[] = [
                            'qty_requested' => $value->getQtyOrdered(),
                            'reason' => 'reason',
                            'condition' => '8',
                            'resolution' => '4',
                            'order_item_id' => $value->getId()
                        ];
                    }
                    $rmaRequestData = [
                        'contact_email' => '',
                        'comment' => ['comment' => ''],
                        'product_name' => '',
                        'product_sku' => '',
                        'qty_ordered' => '',
                        'qty_requested' => '',
                        'reason_other' => '',
                        'reason' => '',
                        'condition' => '',
                        'resolution' => '',
                        'items' => $item,
                        'select' => '',
                        'sku' => '',
                        'price' => [
                            'from' => '',
                            'to' => ''
                        ]
                    ];
                    $saveRequest = $this->rmaDataMapper->filterRmaSaveRequest($rmaRequestData);
                    $model->setData(
                        $this->rmaDataMapper->prepareNewRmaInstanceData(
                            $saveRequest,
                            $order
                        )
                    );
                    if (!$model->saveRma($saveRequest)) {
                        $result['result'] = false;
                        $result['message'] = __('We can\'t save this RMA.');
                        return ($result);
                    }
                    $this->_processNewRmaAdditionalInfo($saveRequest, $model);
                }catch(\Exception $e){
                    $result['result'] = false;
                    $result['message'] = $e->getMessage();
                    return ($result);
                }
            }
            if ($order->canCreditmemo()) {
                $creditmemo = $this->creditmemoFactory->createByOrder($order);
                $this->creditmemoService->refund($creditmemo);
                $order->addStatusHistoryComment('Credit memo created by api and change status to ' . $toStatus, $toStatus);
                $result['result'] = true;
                $result['message'] = 'Credit memo created by api and change status to ' . $toStatus;
                return ($result);
            } else {
                $result['result'] = false;
                $result['message'] = 'Can not create creditmemo';
                return ($result);
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
                return ($result);
            } else {
                $result['result'] = false;
                $result['message'] = 'Can not create shipment';
                return ($result);
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


    protected function _initModel($order)
    {
        /** @var $model \Magento\Rma\Model\Rma */
        $model = $this->_objectManager->create(\Magento\Rma\Model\Rma::class);
        $model->setStoreId(0);

//        $rmaId = $this->getRequest()->getParam($requestParam);
//        if ($rmaId) {
//            $model->load($rmaId);
//            if (!$model->getId()) {
//                throw new \Magento\Framework\Exception\LocalizedException(__('The wrong RMA was requested.'));
//            }
//            $this->_coreRegistry->register('current_rma', $model);
//            $orderId = $model->getOrderId();
//        } else {
            $orderId = $order->getId();
//        }

        if ($orderId) {
            /** @var $order \Magento\Sales\Model\Order */
            $order = $this->_objectManager->create(\Magento\Sales\Model\Order::class)->load($orderId);
            if (!$order->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(__('This is the wrong RMA order ID.'));
            }
//            $this->_coreRegistry->register('current_order', $order);
        }

        return $model;
    }

    protected function _processNewRmaAdditionalInfo(array $saveRequest, \Magento\Rma\Model\Rma $rma)
    {
        /** @var $statusHistory \Magento\Rma\Model\Rma\Status\History */
        $systemComment = $this->_objectManager->create(\Magento\Rma\Model\Rma\Status\History::class);
        $systemComment->setRmaEntityId($rma->getEntityId());
        if (isset($saveRequest['rma_confirmation']) && $saveRequest['rma_confirmation']) {
            try {
                $systemComment->sendNewRmaEmail();
            } catch (\Magento\Framework\Exception\MailException $exception) {
                $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($exception);
            }
        }
        $systemComment->saveSystemComment();
        if (!empty($saveRequest['comment']['comment'])) {
            $visible = isset($saveRequest['comment']['is_visible_on_front']);
            /** @var $statusHistory \Magento\Rma\Model\Rma\Status\History */
            $customComment = $this->_objectManager->create(\Magento\Rma\Model\Rma\Status\History::class);
            $customComment->setRmaEntityId($rma->getEntityId());
            $customComment->saveComment($saveRequest['comment']['comment'], $visible, true);
        }
        return $this;
    }

    public function setResult($result){
        $this->result->setDataa($result['data']);
        $this->result->setMessage($result['message']);
        $this->result->setResult($result['result']);
        return $this->result;
    }
}
