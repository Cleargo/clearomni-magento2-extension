<?php
namespace Cleargo\Clearomni\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManager;
use Magento\Framework\Webapi\Exception;

class MultiCartOrderPlaceAfterObserver implements ObserverInterface
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
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepos;

    /**
     * @param \Magento\Framework\Event\Manager $eventManager
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Customer\Model\Session $customerSession
     * @param SessionManager $coreSession
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
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    )
    {
        $this->_eventManager = $eventManager;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        $this->_coreSession = $coreSession;
        $this->_date = $date;
        $this->orderItemFactory = $orderItemFactory;
        $this->helper = $helper;
        $this->orderRepository = $orderRepositoryInterface;
        $this->searchCriteria = $criteria;
        $this->filterGroup = $filterGroup;
        $this->filterBuilder = $filterBuilder;
        $this->_searchCriteria = $searchCriteriaBuilder;
        $this->customerRepos = $customerRepositoryInterface;
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
        $result = $observer->getResult();
        if (!is_array($result)) {//success result which should be order id
            $customer = $this->customerRepos->getById($this->_customerSession->getCustomerId());
            try {
                $order = $this->orderRepository->get($result);
                $order->setCustomerId($this->_customerSession->getCustomerId());
                $order->setCustomerIsGuest(0);
                $order->setCustomerFirstname($customer->getFirstname());
                $order->setCustomerLastname($customer->getLastname());
                $order->setCustomerMiddlename($customer->getMiddlename());
                $order->setCustomerDob($customer->getDob());
                $order->setCustomerGender($customer->getGender());
                $order->setCustomerEmail($customer->getEmail());
                $order->setCustomerPrefix($customer->getPrefix());
                $order->setCustomerSuffix($customer->getSuffix());
                $this->orderRepository->save($order);
            } catch (\Exception $e) {

            }
        }
    }
}
