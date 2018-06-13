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
     * @var \Cleargo\Clearomni\Api\OrderRepositoryInterface
     */
    protected $clearomniOrderRepository;
    /**
     * @var \Cleargo\Clearomni\Api\OrderItemRepositoryInterface
     */
    protected $clearomniOrderItemRepository;
    /**
     * @var \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    protected $result;

    /**
     * @var \Magento\Sales\Model\Service\InvoiceService
     */
    protected $invoiceService;

    /**
     * @var \Magento\Framework\DB\Transaction
     */
    protected $transaction;

    /**
     * @var \Magento\Sales\Model\Order\Email\Sender\InvoiceSender
     */
    protected $invoiceSender;
    /**
     * @var \Cleargo\Clearomni\Helper\Data
     */
    protected $emailHelper;

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
        \Cleargo\Clearomni\Api\Data\ApiResultInterface $apiResult,
        \Cleargo\Clearomni\Api\OrderRepositoryInterface $clearomniOrderRepository,
        \Cleargo\Clearomni\Api\OrderItemRepositoryInterface $clearomniOrderItemRepository,
        \Magento\Sales\Model\Service\InvoiceService $invoiceService,
        \Magento\Framework\DB\Transaction $transaction,
        \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $invoiceSender,
        \Cleargo\Clearomni\Helper\Data $emailHelper
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
        $this->clearomniOrderRepository=$clearomniOrderRepository;
        $this->clearomniOrderItemRepository=$clearomniOrderItemRepository;
        $this->invoiceService=$invoiceService;
        $this->transaction=$transaction;
        $this->result=$apiResult;
        $this->invoiceSender=$invoiceSender;
        $this->emailHelper=$emailHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function postOrder($param)
    {
        return 'hello api POST return the $param ' . $param;
    }

    /**
     * {@inheritdoc}
     */
    public function updateOrder($param,$items)
    {
        /**
         * param:{"order_id":"","status":""}
         */
        /**
        {
        "param": {
        "order_id": "128",
        "status": "closed_exchange_success",
        "staff_code": "",
        "clearomni_remarks": "",
        "pickup_store": "",
        "pickup_store_label": "",
        "pickup_store_clearomni_id": ""
        },
        "items": [
        {
        "order_item_id": "211",
        "qty_clearomni_reserved": "99",
        "qty_clearomni_to_transfer": "99",
        "qty_clearomni_cancelled": "99",
        "qty_clearomni_completed": "99",
        "qty_clearomni_refunded": "99",
        "qty_clearomni_exchange_success": "99",
        "qty_clearomni_exchange_rejected": "99"
        }
        ]
        }

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
            $orderRepo = $this->orderRepository->get($orderId);
            $order = $this->orderFactory->create()->load($orderId);
            $oldStatus=$order->getStatus();
            try{//order exist
                $clearomniOrder = $this->clearomniOrderRepository->getByOrderId($orderId);
            }catch (\Exception $e){
                $result['result']=false;
                $result['message']=$e->getMessage();
                return $this->setResult($result);
            }
        } catch (\Exception $e) {
            $result['result'] = false;
            $result['message'] = $e->getMessage();
            return $this->setResult($result);
        }
        //update order detail
        if(!empty($param['staff_code'])) {
            $clearomniOrder->setStaffCode($param['staff_code']);
        }
        if(!empty($param['clearomni_remarks'])) {
            $clearomniOrder->setClearomniRemarks($param['clearomni_remarks']);
        }
        if(!empty($param['clearomni_remarks'])) {
            $clearomniOrder->setClearomniRemarks($param['clearomni_remarks']);
        }
        if(!empty($param['pickup_store'])) {
            $clearomniOrder->setPickupStore($param['pickup_store']);
        }
        if(!empty($param['pickup_store_label'])) {
            $clearomniOrder->setPickupStoreLabel($param['pickup_store_label']);
        }
        if(!empty($param['pickup_store_clearomni_id'])) {
            $clearomniOrder->setPickupStoreClearomniId($param['pickup_store_clearomni_id']);
        }
        if(!empty($param['visiting_date'])) {
            $clearomniOrder->setVisitingDate($param['visiting_date']);
        }
        if(!empty($param['visiting_hour'])) {
            $clearomniOrder->setVisitingHour($param['visiting_hour']);
        }
        if(!empty($items)){
            foreach ($items as $key=>$value){
                /**
                 * @var \Cleargo\Clearomni\Api\Data\OrderItemInterface $value
                 */
                $orderItem=$this->clearomniOrderItemRepository->getByItemId($value->getOrderItemId());
                $temp=$value->getQtyClearomniReserved();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniReserved())&&$value->getQtyClearomniReserved()!=="0") {
                    $orderItem->setQtyClearomniReserved($value->getQtyClearomniReserved());
                }
                $temp=$value->getQtyClearomniToTransfer();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniToTransfer()&&$value->getQtyClearomniToTransfer()!=="0")) {
                    $orderItem->setQtyClearomniToTransfer($value->getQtyClearomniToTransfer());
                }
                $temp=$value->getQtyClearomniCancelled();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniCancelled())&&$value->getQtyClearomniCancelled()!=="0") {
                    $orderItem->setQtyClearomniCancelled($value->getQtyClearomniCancelled());
                }
                $temp=$value->getQtyClearomniCompleted();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniCompleted())&&$value->getQtyClearomniCompleted()!=="0") {
                    $orderItem->setQtyClearomniCompleted($value->getQtyClearomniCompleted());
                }
                $temp=$value->getQtyClearomniRefunded();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniRefunded())&&$value->getQtyClearomniRefunded()!=="0") {
                    $orderItem->setQtyClearomniRefunded($value->getQtyClearomniRefunded());
                }
                $temp=$value->getQtyClearomniExchangeSuccess();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniExchangeSuccess())&&$value->getQtyClearomniExchangeSuccess()!=="0") {
                    $orderItem->setQtyClearomniExchangeSuccess($value->getQtyClearomniExchangeSuccess());
                }
                $temp=$value->getQtyClearomniExchangeRejected();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniExchangeRejected())&&$value->getQtyClearomniExchangeRejected()!=="0") {
                    $orderItem->setQtyClearomniExchangeRejected($value->getQtyClearomniExchangeRejected());
                }
                $temp=$value->getQtyClearomniStillConsidering();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniStillConsidering())&&$value->getQtyClearomniStillConsidering()!=="0") {
                    $orderItem->setQtyClearomniStillConsidering($value->getQtyClearomniStillConsidering());
                }
                $temp=$value->getQtyClearomniNotInterested();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniNotInterested())&&$value->getQtyClearomniNotInterested()!=="0") {
                    $orderItem->setQtyClearomniNotInterested($value->getQtyClearomniNotInterested());
                }
                $temp=$value->getQtyClearomniNoShow();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniNoShow())&&$value->getQtyClearomniNoShow()!=="0") {
                    $orderItem->setQtyClearomniNoShow($value->getQtyClearomniNoShow());
                }
                $temp=$value->getQtyClearomniClosed();
                if(isset($temp)) {
//                    if(!empty($value->getQtyClearomniClosed())&&$value->getQtyClearomniClosed()!=="0") {
                    $orderItem->setQtyClearomniClosed($value->getQtyClearomniClosed());
                }
                $this->clearomniOrderItemRepository->save($orderItem);
            }
        }
        $this->clearomniOrderRepository->save($clearomniOrder);
        $status = $param['status'];
        $state = $this->getOrderState($status);
        $statusExist = $this->checkStatusExist($status);
        if ($statusExist <= 0) {
            $result['result'] = false;
            $result['message'] = 'Order Status not exist';
            return $this->setResult($result);
        }
        $sendEmail=isset($param['send_email']);
        if ($state == $order->getState()) {
            if ($statusExist > 0) {
                if($order->canInvoice()){
                    $result = $this->handleOrder($order, $status);
                    return $this->setResult($result);
                }
                if($status!=$oldStatus) {
                    $order->addStatusHistoryComment('Order Status is updated to ' . $status . ' by api' . 'with below payload' . json_encode($param), $status);
                    $sendEmail=false;
                }
                $result['result'] = true;
                $result['message'] = 'Order Status is updated to ' . $status;
                if($status==$oldStatus){
                    $result['message'].='(Status is same so dont add history comment and no email is sent)'.$status.' '.$oldStatus;
                }
            } else {
                $result['result'] = false;
                $result['message'] = 'Order Status not exist';
                return $this->setResult($result);
            }
        } else {
            $result = $this->handleOrder($order, $status);
        }
        $order->setUpdatedAt(gmdate('Y-m-d H:i:s'));
        $order->setOldStatus($oldStatus);
        $order->save();
        if($sendEmail){

            $status=$order->getStatus();

            $template='no_template';
            switch ($status){
                case 'closed_exchange_success':
                    $template=$this->emailHelper->getExchangeSuccess();
                    break;
                case 'closed_refund_success':
                    $template=$this->emailHelper->getRefundSuccess();
                    break;
                case 'copmlete_exchange_requested':
                    $template=$this->emailHelper->getExchangeRequested();
                    break;
                case 'complete_exchange_rejected':
                    $template=$this->emailHelper->getExchangeRejected();
                    break;
                case 'complete_exchange_acknowledged':
                    $template=$this->emailHelper->getExchangeAcknowledged();
                    break;
                case 'processing_pending_transfer':
                    $template=$this->emailHelper->getPendingTransfer();
                    break;
                case 'processing_expired':
                    $template=$this->emailHelper->getExpired();
                    break;
                case 'processing_canceled':
                    $template=$this->emailHelper->getCanceled();
                    break;
                case 'processing_ready_to_pick':
                    if($order->getCustomerId()>0) {
                        $template = $this->emailHelper->getReadyToPick();
                    }else{
                        $template = $this->emailHelper->getReadyToPickGuest();
                    }
                    break;
            }
            var_dump($template);
            if($template!='no_template'){
                //send status change email
                $this->emailHelper->sendEmail($template, $order);
            }
        }

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
        if($toState=='processing'){
            if($order->getState()=='new'||$order->getState()=='processing'){
                if($order->canInvoice()){
                    $qtys=[];
                    foreach ($order->getAllItems() as $key=>$value){
                        $orderItem=$this->clearomniOrderItemRepository->getByItemId($value->getItemId());
                        if($value->getQtyOrdered()-$value->getQtyInvoiced()-$orderItem->getQtyClearomniCancelled()>0) {
                            $qtys[$value->getItemId()] = $value->getQtyOrdered() - $value->getQtyInvoiced() - $orderItem->getQtyClearomniCancelled();
                        }
                    }
                    $invoice_object = $this->invoiceService->prepareInvoice($order,$qtys);

                    // Make sure there is a qty on the invoice
                    if (!$invoice_object->getTotalQty()) {
                        throw new \Magento\Framework\Exception\LocalizedException(
                            __('You can\'t create an invoice without products.'));
                    }
                    // Register as invoice item
                    if(in_array($order->getPayment()->getMethod(),['checkmo','clickandreserve','free'])) {
                        $invoice_object->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_OFFLINE);
                    }else{
                        $invoice_object->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_ONLINE);
                    }
                    $invoice_object->register();

                    // Save the invoice to the order
                    $transaction = $this->transaction
                        ->addObject($invoice_object)
                        ->addObject($invoice_object->getOrder());

                    $transaction->save();


                    // Magento\Sales\Model\Order\Email\Sender\InvoiceSender
                    //$this->
                $this->invoiceSender->send($invoice_object);
                    $order->addStatusHistoryComment('Invoice created by api and change status to ' . $toStatus, $toStatus)->save();
                    $result['result'] = true;
                    $result['message'] = 'Invoice created by api and change status to ' . $toStatus;
                    return $result;
                }
            }
        }
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
//            if ($order->canCreditmemo()) {
//                $creditmemo = $this->creditmemoFactory->createByOrder($order);
//                $this->creditmemoService->refund($creditmemo);
//                $order->addStatusHistoryComment('Credit memo created by api and change status to ' . $toStatus, $toStatus);
//                $result['result'] = true;
//                $result['message'] = 'Credit memo created by api and change status to ' . $toStatus;
//                return ($result);
//            } else {
//                $result['result'] = false;
//                $result['message'] = 'Can not create creditmemo';
//                return ($result);
//            }
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
        return $result;
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
        $this->result->setResultData($result['data']);
        $this->result->setMessage($result['message']);
        $this->result->setResult($result['result']);
        return $this->result;
    }
}
