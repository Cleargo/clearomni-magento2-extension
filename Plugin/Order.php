<?php

namespace Cleargo\Clearomni\Plugin;

class Order
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
     * @var \Cleargo\Clearomni\Helper\Data
     */
    protected $emailHelper;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Cleargo\Clearomni\Model\OrderItemRepository $orderItemRepository,
        \Magento\Customer\Api\GroupRepositoryInterface $customerGroupRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Cleargo\Clearomni\Helper\Data $emailHelper
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->storeManager = $storeManager;
        $this->emailHelper=$emailHelper;
    }

    //need to use around method to get the order object
    public function aroundSave($object, callable $proceed, \Magento\Framework\Model\AbstractModel $order)
    {
        $oldStatus=$order->getStatus();
        //handle status change
        $result = $proceed($order);

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
                $template=$this->emailHelper->getReadyToPick();
                break;
        }
        if($template!='no_template'){
            //send status change email
            if($order->getOldStatus()!=$status) {
                $this->emailHelper->sendEmail($template, $order);
            }
        }
        return $result;
    }

}