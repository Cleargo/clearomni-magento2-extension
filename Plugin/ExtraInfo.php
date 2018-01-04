<?php

namespace Cleargo\Clearomni\Plugin;

class ExtraInfo
{

    protected $quoteRepository;
    protected $orderItemRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Cleargo\Clearomni\Model\OrderItemRepository $orderItemRepository
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function afterGetList(
        $subject,
        $result
    )
    {

        foreach ($result as $key => $value) {
            foreach ($value->getAllItems() as $key2=>$value2) {
                $extensionAttributes = $value2->getExtensionAttributes();
                $orderItem=$this->orderItemRepository->getByItemId($value2->getId());
                $extensionAttributes->setQtyClearomniReserved($orderItem->getQtyClearomniReserved());
                $extensionAttributes->setQtyClearomniToTransfer($orderItem->getQtyClearomniToTransfer());
                $extensionAttributes->setQtyClearomniCancelled($orderItem->getQtyClearomniCancelled());
                $extensionAttributes->setQtyClearomniCompleted($orderItem->getQtyClearomniCompleted());
                $extensionAttributes->setQtyClearomniRefunded($orderItem->getQtyClearomniRefunded());
                $extensionAttributes->setQtyClearomniExchangeSuccess($orderItem->getQtyClearomniExchangeSuccess());
                $extensionAttributes->setQtyClearomniExchangeRejected($orderItem->getQtyClearomniExchangeRejected());
                $value2->setExtensionAttributes($extensionAttributes);
            }
        }
        return $result;
    }
}