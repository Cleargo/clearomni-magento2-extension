<?php
namespace Cleargo\Clearomni\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManager;
use Magento\Framework\Webapi\Exception;

class MultiCartOrderPlaceBeforeObserver implements ObserverInterface
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
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    public $orderRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    public $searchCriteria;
    /**
     * @var \Magento\Framework\Api\Search\FilterGroup
     */
    public $filterGroup;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    public $filterBuilder;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $_searchCriteria;
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
        \Smile\Retailer\Api\RetailerRepositoryInterface $retailerRepository,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->_eventManager = $eventManager;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        $this->_coreSession = $coreSession;
        $this->_date = $date;
        $this->orderItemFactory=$orderItemFactory;
        $this->helper=$helper;
        $this->retailerRepository=$retailerRepository;
        $this->orderRepository = $orderRepositoryInterface;
        $this->searchCriteria = $criteria;
        $this->filterGroup = $filterGroup;
        $this->filterBuilder = $filterBuilder;
        $this->_searchCriteria = $searchCriteriaBuilder;
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
        if($this->helper->getMaxReserve()>0) {
            $count=0;
            $payload=$observer->getPayload();
            if($payload['paymentMethod']['method']=='clickandreserve') {
                $maxReserve = $this->helper->getMaxReserve();
                if ($this->_customerSession->isLoggedIn()) {
                    $this->searchCriteria=$this->_searchCriteria
                        ->addFilter('state','processing')
                        ->addFilter('customer_id',$this->_customerSession->getCustomer()->getId())->create();
                    $list = $this->orderRepository->getList($this->searchCriteria);
//                    echo $list->getSelect();
//                    exit;
                    foreach ($list->getItems() as $key=>$value){
                        if($value->getPayment()->getMethod()=='clickandreserve'){
                            $count++;
                        }
                    }
                    if($count>=$maxReserve){
                        throw new \Magento\Framework\Exception\LocalizedException(__('Excess max reserve limit'));
                    }
                }
            }
        }

        
    }
}
