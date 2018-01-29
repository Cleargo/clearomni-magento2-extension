<?php

namespace Cleargo\Clearomni\Plugin;

class ExtraInfo
{

    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;
    /**
     * @var \Cleargo\Clearomni\Model\OrderItemRepository
     */
    protected $orderItemRepository;
    /**
     * @var \Magento\Customer\Api\GroupRepositoryInterface
     */
    protected $customerGroupRepository;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \Cleargo\Clearomni\Model\OrderRepository
     */
    protected $orderRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $_searchCriteria;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    public $searchCriteria;

    /**
     * @var \Cleargo\Clearomni\Helper\Util
     */
    protected $util;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Cleargo\Clearomni\Model\OrderItemRepository $orderItemRepository,
        \Cleargo\Clearomni\Model\OrderRepository $orderRepository,
        \Magento\Customer\Api\GroupRepositoryInterface $customerGroupRepository,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Cleargo\Clearomni\Helper\Util $util
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderRepository = $orderRepository;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->searchCriteria = $criteria;
        $this->_searchCriteria = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
        $this->util=$util;
    }

    public function afterGetList(
        $subject,
        $result
    )
    {
        foreach ($result as $key => $value) {
            foreach ($value->getAllItems() as $key2 => $value2) {
                $extensionAttributes = $value2->getExtensionAttributes();
                try {
                    $orderItem = $this->orderItemRepository->getByItemId($value2->getId());
                    $extensionAttributes->setQtyClearomniReserved($orderItem->getQtyClearomniReserved());
                    $extensionAttributes->setQtyClearomniToTransfer($orderItem->getQtyClearomniToTransfer());
                    $extensionAttributes->setQtyClearomniCancelled($orderItem->getQtyClearomniCancelled());
                    $extensionAttributes->setQtyClearomniCompleted($orderItem->getQtyClearomniCompleted());
                    $extensionAttributes->setQtyClearomniRefunded($orderItem->getQtyClearomniRefunded());
                    $extensionAttributes->setQtyClearomniExchangeSuccess($orderItem->getQtyClearomniExchangeSuccess());
                    $extensionAttributes->setQtyClearomniExchangeRejected($orderItem->getQtyClearomniExchangeRejected());
                } catch (\Exception $e) {

                }
                $value2->setExtensionAttributes($extensionAttributes);
            }
            $extensionAttributes2 = $value->getExtensionAttributes();
            try {
                $customerGroup = $this->customerGroupRepository->getById($value->getCustomerGroupId());
                $extensionAttributes2->setCustomerGroupName($customerGroup->getCode());
            } catch (\Exception $e) {

            }
            try {
                $store = $this->storeManager->getStore($value->getStoreId());
                $extensionAttributes2->setWebsiteId($store->getWebsiteId());
            } catch (\Exception $e) {
            }
            try {
                $extensionAttributes2->setCustomerGroupId($value->getCustomerGroupId());
            } catch (\Exception $e) {
            }
            $this->searchCriteria=$this->_searchCriteria
                ->addFilter('magento_order_id',$value->getId())->create();
            $list = $this->orderRepository->getList($this->searchCriteria);
            foreach ($list->getItems() as $key3=>$value3){
                $order=$value3;
                break;
            }
            try {
                if(isset($order)) {
                    $extensionAttributes2->setClearomniRemarks($order->getClearomniRemarks());
                    $extensionAttributes2->setStaffCode($order->getStaffCode());
                    $extensionAttributes2->setOrderType($this->util->getOrderType($value));//reserve/connect
                    $extensionAttributes2->setPickupStore($order->getPickupStore());
                    $extensionAttributes2->setPickupStoreLabel($order->getPickupStoreLabel());
                    $extensionAttributes2->setPickupStoreClearomniId($order->getPickupStoreClearomniId());
                }
            } catch (\Exception $e) {
            }
            $value->setExtensionAttributes($extensionAttributes2);
        }
        return $result;
    }

    public function afterGet(
        $subject,
        $value
    )
    {
        foreach ($value->getAllItems() as $key2 => $value2) {
            $extensionAttributes = $value2->getExtensionAttributes();
            try {
                $orderItem = $this->orderItemRepository->getByItemId($value2->getId());
                $extensionAttributes->setQtyClearomniReserved($orderItem->getQtyClearomniReserved());
                $extensionAttributes->setQtyClearomniToTransfer($orderItem->getQtyClearomniToTransfer());
                $extensionAttributes->setQtyClearomniCancelled($orderItem->getQtyClearomniCancelled());
                $extensionAttributes->setQtyClearomniCompleted($orderItem->getQtyClearomniCompleted());
                $extensionAttributes->setQtyClearomniRefunded($orderItem->getQtyClearomniRefunded());
                $extensionAttributes->setQtyClearomniExchangeSuccess($orderItem->getQtyClearomniExchangeSuccess());
                $extensionAttributes->setQtyClearomniExchangeRejected($orderItem->getQtyClearomniExchangeRejected());
            } catch (\Exception $e) {

            }
            $value2->setExtensionAttributes($extensionAttributes);
        }
        $extensionAttributes2 = $value->getExtensionAttributes();
        try {
            $customerGroup = $this->customerGroupRepository->getById($value->getCustomerGroupId());
            $extensionAttributes2->setCustomerGroupName($customerGroup->getCode());
        } catch (\Exception $e) {
        }
        try {
            $store = $this->storeManager->getStore($value->getStoreId());
            $extensionAttributes2->setWebsiteId($store->getWebsiteId());
        } catch (\Exception $e) {
        }
        try {
            $extensionAttributes2->setCustomerGroupId($value->getCustomerGroupId());
        } catch (\Exception $e) {
        }
        $this->searchCriteria=$this->_searchCriteria
            ->addFilter('magento_order_id',$value->getId())->create();
        $list = $this->orderRepository->getList($this->searchCriteria);
        foreach ($list->getItems() as $key3=>$value3){
            $order=$value3;
            break;
        }
        try {
            if(isset($order)) {
                $extensionAttributes2->setClearomniRemarks($order->getClearomniRemarks());
                $extensionAttributes2->setStaffCode($order->getStaffCode());
                $extensionAttributes2->setOrderType($this->util->getOrderType($value));//reserve/connect
                $extensionAttributes2->setPickupStore($order->getPickupStore());
                $extensionAttributes2->setPickupStoreLabel($order->getPickupStoreLabel());
                $extensionAttributes2->setPickupStoreClearomniId($order->getPickupStoreClearomniId());
            }
        } catch (\Exception $e) {
        }
        $value->setExtensionAttributes($extensionAttributes2);
        return $value;
    }
}