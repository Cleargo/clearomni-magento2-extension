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

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Cleargo\Clearomni\Model\OrderItemRepository $orderItemRepository,
        \Magento\Customer\Api\GroupRepositoryInterface $customerGroupRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->storeManager = $storeManager;
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
        $value->setExtensionAttributes($extensionAttributes2);
        return $value;
    }
}