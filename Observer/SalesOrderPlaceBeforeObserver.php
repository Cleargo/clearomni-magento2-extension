<?php
namespace Cleargo\Clearomni\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManager;
use Magento\Framework\Webapi\Exception;

class SalesOrderPlaceBeforeObserver implements ObserverInterface
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
     * @var \Cleargo\Clearomni\Helper\Data
     */
    protected $helper;

    /**
     * @var \Cleargo\AigleClearomniConnector\Helper\Data
     */
    protected $aigleHelper;

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
        \Cleargo\Clearomni\Helper\Data $helper,
        \Smile\Retailer\Api\RetailerRepositoryInterface $retailerRepository
    ) {
        $this->_eventManager = $eventManager;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        $this->_coreSession = $coreSession;
        $this->_date = $date;
        $this->orderItemFactory=$orderItemFactory;
        $this->helper=$helper;
        $this->retailerRepository=$retailerRepository;
    }

    /**
     * Sales Order Place After event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /**
         * @var $quote \Magento\Quote\Model\Quote
         */
        $quote = $observer->getQuote();
        $storeAvail = $this->helper->getCartAvailableInStore('cnc');
        $code='';
        try{
            $retailer=$this->retailerRepository->get($quote->getShippingAddress()->getRetailerId());
            $code=$retailer->getSellerCode();

        }catch (\Exception $e){
        }
        $selectedStore=false;
        foreach ($storeAvail as $key=>$value){
            if($value['code']==$code){
                $selectedStore=$value;
            }
        }
        if($selectedStore){
            if($selectedStore['available']==false){
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Some of product is out of stock')
                );
            }
        }
        
    }
}