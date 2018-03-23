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

    /**
     * @var \Cleargo\Clearomni\Model\Data\ProductOptionFactory
     */
    public $productOptionFactory;

    public $connection;

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
        \Cleargo\Clearomni\Helper\Util $util,
        \Cleargo\Clearomni\Model\Data\ProductOptionFactory $productOptionFactory
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
        $this->productOptionFactory=$productOptionFactory;
        $this->connection = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection')->getConnection();

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
                    $extensionAttributes->setQtyClearomniReadyToPick($orderItem->getQtyClearomniReadyToPick());
                    $extensionAttributes->setQtyClearomniStillConsidering($orderItem->getQtyClearomniStillConsidering());
                    $extensionAttributes->setQtyClearomniNotInterested($orderItem->getQtyClearomniNotInterested());
                    $extensionAttributes->setQtyClearomniNoShow($orderItem->getQtyClearomniNoShow());
                    $extensionAttributes->setQtyClearomniClosed($orderItem->getQtyClearomniClosed());
                    $productOptions=$value2->getProductOptions();
                    /**
                     * @var $productOption \Cleargo\Clearomni\Api\Data\ProductOptionInterface
                     */
                    if(!empty($productOptions)) {
                        foreach ($productOptions as $key3 => $value3) {
                            $productOption = $this->productOptionInterfaceFactory->create();
                            $productOption->setName();
                        }
                    }
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
                $extensionAttributes->setQtyClearomniReadyToPick($orderItem->getQtyClearomniReadyToPick());
                $extensionAttributes->setQtyClearomniStillConsidering($orderItem->getQtyClearomniStillConsidering());
                $extensionAttributes->setQtyClearomniNotInterested($orderItem->getQtyClearomniNotInterested());
                $extensionAttributes->setQtyClearomniNoShow($orderItem->getQtyClearomniNoShow());
                $extensionAttributes->setQtyClearomniClosed($orderItem->getQtyClearomniClosed());
                $productOptions=$value2->getProductOptions();
                /**
                 * @var $productOption \Cleargo\Clearomni\Api\Data\ProductOptionInterface
                 */
                $temp=[];
                if(isset($productOptions['info_buyRequest'])) {
                    if(isset($productOptions['info_buyRequest']['options'])) {
                        $nameDefaultQuery=$this->connection->prepare('select title from catalog_product_option_title where option_id=? and store_id=0');
                        $valueDefaultQuery=$this->connection->prepare('select title from catalog_product_option_type_title where option_type_id=? and store_id=0');
                        $nameQuery=$this->connection->prepare('select title from catalog_product_option_title where option_id=? and store_id=?');
                        $valueQuery=$this->connection->prepare('select title from catalog_product_option_type_title where option_type_id=? and store_id=?');
                        foreach ($productOptions['info_buyRequest']['options'] as $key3 => $value3) {
                            $nameDefaultQuery->bindValue(1,$key3);
                            $nameDefaultQuery->execute();
                            $nameDefault=$nameDefaultQuery->fetch();
                            $valueDefaultQuery->bindValue(1,$value3);
                            $valueDefaultQuery->execute();
                            $optionValueDefault=$valueDefaultQuery->fetch();
                            $nameQuery->bindValue(1,$key3);
                            $nameQuery->bindValue(2,$value2->getOrder()->getStoreId());
                            $nameQuery->execute();
                            $name=$nameQuery->fetch();
                            $valueQuery->bindValue(1,$value3);
                            $valueQuery->bindValue(2,$value2->getOrder()->getStoreId());
                            $valueQuery->execute();
                            $optionValue=$valueQuery->fetch();
                            $productOption = $this->productOptionFactory->create();
                            $productOption->setNameId($key3);
                            $productOption->setName($name['title']);
                            $productOption->setValueId($value3);
                            $productOption->setValue($optionValue['title']);
                            $productOption->setDefaultName($nameDefault['title']);
                            $productOption->setDefaultValue($optionValueDefault['title']);
                            $temp[]=$productOption;
                        }
                    }
                }
                $extensionAttributes->setProductOption($temp);
            } catch (\Exception $e) {
                throw $e;
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
                $extensionAttributes2->setVisitingDate($order->getVisitingDate());
                $extensionAttributes2->setVisitingHour($order->getVisitingHour());
            }
        } catch (\Exception $e) {
        }
        $value->setExtensionAttributes($extensionAttributes2);
        return $value;
    }
}