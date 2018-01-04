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
     *
     */
    protected $orderItemFactory;
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
        \Cleargo\Clearomni\Model\OrderItemFactory $orderItemFactory
    ) {
        $this->_eventManager = $eventManager;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        $this->_coreSession = $coreSession;
        $this->_date = $date;
        $this->orderItemFactory=$orderItemFactory;
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

    }
}
