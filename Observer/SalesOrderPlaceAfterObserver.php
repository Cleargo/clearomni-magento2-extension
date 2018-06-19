<?php
namespace Cleargo\Clearomni\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManager;
use Magento\Framework\Webapi\Exception;

class SalesOrderPlaceAfterObserver implements ObserverInterface
{
    /**
     * @var eventManager
     */
    protected $_eventManager;

    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * [$_coreSession description]
     * @var SessionManager
     */
    protected $_coreSession;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Cleargo\Clearomni\Model\OrderItemFactory
     */
    protected $orderItemFactory;

    /**
     * @var \Cleargo\Clearomni\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * @var \Cleargo\Clearomni\Helper\Data
     */
    protected $helper;

    /**
     * @var \Cleargo\Clearomni\Helper\Request
     */
    protected $requestHelper;

    /**
     * @var \Cleargo\Clearomni\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var \Cleargo\Clearomni\Model\Order
     */
    protected $order;

    protected $connection;
    /**
     * @var \Smile\Retailer\Api\RetailerRepositoryInterface
     */
    protected $retailerRepository;
    /**
     * @param \Magento\Framework\Event\Manager            $eventManager
     * @param \Magento\Framework\ObjectManagerInterface   $objectManager
     * @param \Magento\Customer\Model\Session             $customerSession
     * @param SessionManager                              $coreSession
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     */
    public function __construct(
        \Magento\Framework\Event\Manager $eventManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Customer\Model\Session $customerSession,
        SessionManager $coreSession,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Cleargo\Clearomni\Model\OrderItemFactory $orderItemFactory,
        \Cleargo\Clearomni\Model\OrderFactory $orderFactory,
        \Cleargo\Clearomni\Api\OrderRepositoryInterface $orderRepository,
        \Cleargo\Clearomni\Helper\Data $helper,
        \Cleargo\Clearomni\Helper\Request $requestHelper,
        \Smile\Retailer\Api\RetailerRepositoryInterface $retailerRepository,
        \Cleargo\Clearomni\Model\Order $order
    ) {
        $this->_eventManager = $eventManager;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        $this->_coreSession = $coreSession;
        $this->_date = $date;
        $this->orderItemFactory=$orderItemFactory;
        $this->orderFactory=$orderFactory;
        $this->helper=$helper;
        $this->requestHelper=$requestHelper;
        $this->orderRepository=$orderRepository;
        $this->order=$order;
        $this->retailerRepository=$retailerRepository;
        $this->connection=$objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection();
    }

    /**
     * Sales Order Place After event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //insert clearomni_order item

        /**
         * @var $order \Magento\Sales\Model\Order
         */
        $order=$observer->getOrder();
        $clearomniOrder=$this->orderFactory->create();
        try {
            $retailer = $this->retailerRepository->get($order->getShippingAddress()->getRetailerId());
            $clearomniOrder->setPickupStore($retailer->getSellerCode());
            $clearomniOrder->setPickupStoreLabel($retailer->getName());
            $clearomniOrder->setPickupStoreClearomniId($retailer->getClearomniId());
        }catch (\Exception $e){

        }
        $clearomniOrder->setMagentoOrderId($order->getId());
        $clearomniOrder->setClearomniRemarks('');
        $clearomniOrder->save();
//        $this->orderRepository->save($clearomniOrder);
        $allItem=$order->getAllItems();
        foreach ($allItem as $key=>$value){
            $item=$this->orderItemFactory->create();
            $item->setOrderItemId($value->getId());
            $item->setOrderId($value->getOrderId());
//            if($order->getPayment()->getMethod()=='clickandreserve'){
//                $item->setQtyClearomniReserved();
//            }
            $item->save();
        }
        //move to InvoiceRegisterObserver
//        $this->requestHelper->request('/get-order/'.$order->getId());

    }
}
