<?php


namespace Cleargo\Clearomni\Model;

use Cleargo\Clearomni\Api\Data\OrderItemInterface;

class OrderItem extends \Magento\Framework\Model\AbstractModel implements OrderItemInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cleargo\Clearomni\Model\ResourceModel\OrderItem');
    }

    /**
     * Get quoteitem_id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set quoteitem_id
     * @param string $quoteitemId
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setId($quoteitemId)
    {
        $data = $this->getItemData();
        $data[self::ID] = $quoteitemId;
        $this->setItemData($data);
        return $this->setData(self::ID, $quoteitemId);
    }

    /**
     * Get order_item_id
     * @return string
     */
    public function getOrderItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setOrderItemId($order_item_id)
    {
        $data = $this->getItemData();
        $data[self::ORDER_ID] = $order_item_id;
        $this->setItemData($data);
        return $this->setData(self::ORDER_ITEM_ID, $order_item_id);
    }

    /**
     * Get order_id
     * @return string
     */
    public function getQuoteId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQuoteId($order_id)
    {
        $data = $this->getItemData();
        $data[self::ORDER_ID] = $order_id;
        $this->setItemData($data);
        return $this->setData(self::ORDER_ID, $order_id);
    }

    /**
     * Get qty_clearomni_reserved
     * @return string
     */
    public function getQtyClearomniReserved()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_TO_TRANSFER])) {
            return $data[self::QTY_CLEAROMNI_TO_TRANSFER];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_TO_TRANSFER);
        }
        return $this->getData(self::QTY_CLEAROMNI_RESERVED);
    }

    /**
     * Set qty_clearomni_reserved
     * @param string $qty_clearomni_reserved
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniReserved($qty_clearomni_reserved)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_RESERVED] = $qty_clearomni_reserved;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_RESERVED, $qty_clearomni_reserved);
    }

    /**
     * Get qty_clearomni_to_transfer
     * @return string
     */
    public function getQtyClearomniToTransfer()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_TO_TRANSFER])) {
            return $data[self::QTY_CLEAROMNI_TO_TRANSFER];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_TO_TRANSFER);
        }
        return $this->getData(self::QTY_CLEAROMNI_TO_TRANSFER);
    }

    /**
     * Set qty_clearomni_to_transfer
     * @param string $qty_clearomni_to_transfer
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniToTransfer($qty_clearomni_to_transfer)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_TO_TRANSFER] = $qty_clearomni_to_transfer;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_TO_TRANSFER, $qty_clearomni_to_transfer);
    }

    /**
     * Get qty_clearomni_cancelled
     * @return string
     */
    public function getQtyClearomniCancelled()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_CANCELLED])) {
            return $data[self::QTY_CLEAROMNI_CANCELLED];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_CANCELLED);
        }
        return $this->getData(self::QTY_CLEAROMNI_CANCELLED);
    }

    /**
     * Set qty_clearomni_cancelled
     * @param string $qty_clearomni_cancelled
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCancelled($qty_clearomni_cancelled)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_CANCELLED] = $qty_clearomni_cancelled;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_CANCELLED, $qty_clearomni_cancelled);
    }

    /**
     * Get qty_clearomni_completed
     * @return string
     */
    public function getQtyClearomniCompleted()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_COMPLETED])) {
            return $data[self::QTY_CLEAROMNI_COMPLETED];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_COMPLETED);
        }
        return $this->getData(self::QTY_CLEAROMNI_COMPLETED);
    }

    /**
     * Set qty_clearomni_completed
     * @param string $qty_clearomni_completed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCompleted($qty_clearomni_completed)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_COMPLETED] = $qty_clearomni_completed;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_COMPLETED, $qty_clearomni_completed);
    }

    /**
     * Get qty_clearomni_refunded
     * @return string
     */
    public function getQtyClearomniRefunded()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_REFUNDED])) {
            return $data[self::QTY_CLEAROMNI_REFUNDED];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_REFUNDED);
        }
        return $this->getData(self::QTY_CLEAROMNI_REFUNDED);
    }

    /**
     * Set qty_clearomni_refunded
     * @param string $qty_clearomni_refunded
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniRefunded($qty_clearomni_refunded)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_REFUNDED] = $qty_clearomni_refunded;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_REFUNDED, $qty_clearomni_refunded);
    }

    /**
     * Get qty_clearomni_exchange_success
     * @return string
     */
    public function getQtyClearomniExchangeSuccess()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_EXCHANGE_SUCCESS])) {
            return $data[self::QTY_CLEAROMNI_EXCHANGE_SUCCESS];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_SUCCESS);
        }
        return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_SUCCESS);
    }

    /**
     * Set qty_clearomni_exchange_success
     * @param string $qty_clearomni_exchange_success
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeSuccess($qty_clearomni_exchange_success)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_EXCHANGE_SUCCESS] = $qty_clearomni_exchange_success;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_EXCHANGE_SUCCESS, $qty_clearomni_exchange_success);
    }

    /**
     * Get qty_clearomni_exchange_rejected
     * @return string
     */
    public function getQtyClearomniExchangeRejected()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_EXCHANGE_REJECTED])) {
            return $data[self::QTY_CLEAROMNI_EXCHANGE_REJECTED];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_REJECTED);
        }
        return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_REJECTED);
    }

    /**
     * Set qty_clearomni_exchange_rejected
     * @param string $qty_clearomni_exchange_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeRejected($qty_clearomni_exchange_rejected)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_EXCHANGE_REJECTED] = $qty_clearomni_exchange_rejected;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_EXCHANGE_REJECTED, $qty_clearomni_exchange_rejected);
    }

    /**
     * Get qty_clearomni_ready_to_pick
     * @return string
     */
    public function getQtyClearomniReadyToPick()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_STILL_CONSIDERING])) {
            return $data[self::QTY_CLEAROMNI_STILL_CONSIDERING];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_STILL_CONSIDERING);
        }
        return $this->getData(self::QTY_CLEAROMNI_READY_TO_PICK);
    }

    /**
     * Set qty_clearomni_ready_to_pick
     * @param string $qty_clearomni_ready_to_pick
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniReadyToPick($qty_clearomni_ready_to_pick)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_READY_TO_PICK] = $qty_clearomni_ready_to_pick;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_READY_TO_PICK, $qty_clearomni_ready_to_pick);
    }

    /**
     * Get qty_clearomni_still_considering
     * @return string
     */
    public function getQtyClearomniStillConsidering()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_STILL_CONSIDERING])) {
            return $data[self::QTY_CLEAROMNI_STILL_CONSIDERING];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_STILL_CONSIDERING);
        }
        return $this->getData(self::QTY_CLEAROMNI_STILL_CONSIDERING);
    }

    /**
     * Set qty_clearomni_still_considering
     * @param string $qty_clearomni_still_considering
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniStillConsidering($qty_clearomni_still_considering)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_STILL_CONSIDERING] = $qty_clearomni_still_considering;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_STILL_CONSIDERING, $qty_clearomni_still_considering);
    }

    /**
     * Get qty_clearomni_not_interested
     * @return string
     */
    public function getQtyClearomniNotInterested()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_NOT_INTERESTING])) {
            return $data[self::QTY_CLEAROMNI_NOT_INTERESTING];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_NOT_INTERESTING);
        }
        return $this->getData(self::QTY_CLEAROMNI_NOT_INTERESTING);
    }

    /**
     * Set qty_clearomni_not_interested
     * @param string $qty_clearomni_not_interested
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniNotInterested($qty_clearomni_not_interested)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_NOT_INTERESTING] = $qty_clearomni_not_interested;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_NOT_INTERESTING, $qty_clearomni_not_interested);
    }

    /**
     * Get qty_clearomni_no_show
     * @return string
     */
    public function getQtyClearomniNoShow()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_NO_SHOW])) {
            return $data[self::QTY_CLEAROMNI_NO_SHOW];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_NO_SHOW);
        }
        return $this->getData(self::QTY_CLEAROMNI_NO_SHOW);
    }

    /**
     * Set qty_clearomni_no_show
     * @param string $qty_clearomni_no_show
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniNoShow($qty_clearomni_no_show)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_NO_SHOW] = $qty_clearomni_no_show;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_NO_SHOW, $qty_clearomni_no_show);
    }

    /**
     * Get qty_clearomni_closed
     * @return string
     */
    public function getQtyClearomniClosed()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLEAROMNI_CLOSED])) {
            return $data[self::QTY_CLEAROMNI_CLOSED];
        } else {
            return $this->getData(self::QTY_CLEAROMNI_CLOSED);
        }
        return $this->getData(self::QTY_CLEAROMNI_CLOSED);
    }

    /**
     * Set qty_clearomni_closed
     * @param string $qty_clearomni_closed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniClosed($qty_clearomni_closed)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLEAROMNI_CLOSED] = $qty_clearomni_closed;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLEAROMNI_CLOSED, $qty_clearomni_closed);
    }

    public function getQtyLensProduction()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_LENS_PRODUCTION])) {
            return $data[self::QTY_LENS_PRODUCTION];
        } else {
            return $this->getData(self::QTY_LENS_PRODUCTION);
        }
        return $this->getData(self::QTY_LENS_PRODUCTION);
    }

    public function setQtyLensProduction($qty_lens_production)
    {
        $data = $this->getItemData();
        $data[self::QTY_LENS_PRODUCTION] = $qty_lens_production;
        $this->setItemData($data);
        return $this->setData(self::QTY_LENS_PRODUCTION, $qty_lens_production);
    }

    public function getQtyOptomReceived()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_OPTOM_RECEIVED])) {
            return $data[self::QTY_OPTOM_RECEIVED];
        } else {
            return $this->getData(self::QTY_OPTOM_RECEIVED);
        }
        return $this->getData(self::QTY_OPTOM_RECEIVED);
    }

    public function setQtyOptomReceived($qty_optom_received)
    {
        $data = $this->getItemData();
        $data[self::QTY_OPTOM_RECEIVED] = $qty_optom_received;
        $this->setItemData($data);
        return $this->setData(self::QTY_OPTOM_RECEIVED, $qty_optom_received);
    }

    public function getQtyPendingTransfer()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_PENDING_TRANSFER])) {
            return $data[self::QTY_PENDING_TRANSFER];
        } else {
            return $this->getData(self::QTY_PENDING_TRANSFER);
        }
        return $this->getData(self::QTY_PENDING_TRANSFER);
    }

    public function setQtyPendingTransfer($qty_pending_transfer)
    {
        $data = $this->getItemData();
        $data[self::QTY_PENDING_TRANSFER] = $qty_pending_transfer;
        $this->setItemData($data);
        return $this->setData(self::QTY_PENDING_TRANSFER, $qty_pending_transfer);
    }

    public function getQtyPickAndPack()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_PICK_AND_PACK])) {
            return $data[self::QTY_PICK_AND_PACK];
        } else {
            return $this->getData(self::QTY_PICK_AND_PACK);
        }
        return $this->getData(self::QTY_PICK_AND_PACK);
    }

    public function setQtyPickAndPack($qty_pick_and_pack)
    {
        $data = $this->getItemData();
        $data[self::QTY_PICK_AND_PACK] = $qty_pick_and_pack;
        $this->setItemData($data);
        return $this->setData(self::QTY_PICK_AND_PACK, $qty_pick_and_pack);
    }

    public function getQtyReadyToShip()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_READY_TO_SHIP])) {
            return $data[self::QTY_READY_TO_SHIP];
        } else {
            return $this->getData(self::QTY_READY_TO_SHIP);
        }
        return $this->getData(self::QTY_READY_TO_SHIP);
    }

    public function setQtyReadyToShip($qty_ready_to_ship)
    {
        $data = $this->getItemData();
        $data[self::QTY_READY_TO_SHIP] = $qty_ready_to_ship;
        $this->setItemData($data);
        return $this->setData(self::QTY_READY_TO_SHIP, $qty_ready_to_ship);
    }

    public function getQtyToFulfilment()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_TO_FULFILMENT])) {
            return $data[self::QTY_TO_FULFILMENT];
        } else {
            return $this->getData(self::QTY_TO_FULFILMENT);
        }
        return $this->getData(self::QTY_TO_FULFILMENT);
    }

    public function setQtyToFulfilment($qty_to_fulfilment)
    {
        $data = $this->getItemData();
        $data[self::QTY_TO_FULFILMENT] = $qty_to_fulfilment;
        $this->setItemData($data);
        return $this->setData(self::QTY_TO_FULFILMENT, $qty_to_fulfilment);
    }

    public function getQtyTransferringToOptom()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_TRANSFERRING_TO_PICK])) {
            return $data[self::QTY_TRANSFERRING_TO_PICK];
        } else {
            return $this->getData(self::QTY_TRANSFERRING_TO_PICK);
        }
        return $this->getData(self::QTY_TRANSFERRING_TO_OPTOM);
    }

    public function setQtyTransferringToOptom($qty_transferring_to_optom)
    {
        $data = $this->getItemData();
        $data[self::QTY_TRANSFERRING_TO_OPTOM] = $qty_transferring_to_optom;
        $this->setItemData($data);
        return $this->setData(self::QTY_TRANSFERRING_TO_OPTOM, $qty_transferring_to_optom);
    }

    public function getQtyTransferringToPick()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_TRANSFERRING_TO_PICK])) {
            return $data[self::QTY_TRANSFERRING_TO_PICK];
        } else {
            return $this->getData(self::QTY_TRANSFERRING_TO_PICK);
        }
        return $this->getData(self::QTY_TRANSFERRING_TO_PICK);
    }

    public function setQtyTransferringToPick($qty_transferring_to_pick)
    {
        $data = $this->getItemData();
        $data[self::QTY_TRANSFERRING_TO_PICK] = $qty_transferring_to_pick;
        $this->setItemData($data);
        return $this->setData(self::QTY_TRANSFERRING_TO_PICK, $qty_transferring_to_pick);
    }

    public function getQtyToWarehouse()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_TO_WAREHOUSE])) {
            return $data[self::QTY_TO_WAREHOUSE];
        } else {
            return $this->getData(self::QTY_TO_WAREHOUSE);
        }
        return $this->getData(self::QTY_TO_WAREHOUSE);
    }

    public function setQtyToWarehouse($qty_to_warehouse)
    {
        $data = $this->getItemData();
        $data[self::QTY_TO_WAREHOUSE] = $qty_to_warehouse;
        $this->setItemData($data);
        return $this->setData(self::QTY_TO_WAREHOUSE, $qty_to_warehouse);
    }

    public function getQtyToPickupStore()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_TO_PICKUP_STORE])) {
            return $data[self::QTY_TO_PICKUP_STORE];
        } else {
            return $this->getData(self::QTY_TO_PICKUP_STORE);
        }
        return $this->getData(self::QTY_TO_PICKUP_STORE);
    }

    public function setQtyToPickupStore($qty_to_pickup_store)
    {
        $data = $this->getItemData();
        $data[self::QTY_TO_PICKUP_STORE] = $qty_to_pickup_store;
        $this->setItemData($data);
        return $this->setData(self::QTY_TO_PICKUP_STORE, $qty_to_pickup_store);
    }

    public function getQtyCompleted()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_COMPLETED])) {
            return $data[self::QTY_COMPLETED];
        } else {
            return $this->getData(self::QTY_COMPLETED);
        }
        return $this->getData(self::QTY_COMPLETED);
    }

    public function setQtyCompleted($qty_completed)
    {
        $data = $this->getItemData();
        $data[self::QTY_COMPLETED] = $qty_completed;
        $this->setItemData($data);
        return $this->setData(self::QTY_COMPLETED, $qty_completed);
    }

    public function getQtyCancelled()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CANCELLED])) {
            return $data[self::QTY_CANCELLED];
        } else {
            return $this->getData(self::QTY_CANCELLED);
        }
        return $this->getData(self::QTY_CANCELLED);
    }

    public function setQtyCancelled($qty_cancelled)
    {
        $data = $this->getItemData();
        $data[self::QTY_CANCELLED] = $qty_cancelled;
        $this->setItemData($data);
        return $this->setData(self::QTY_CANCELLED, $qty_cancelled);
    }

    public function getQtyClosed()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_CLOSED])) {
            return $data[self::QTY_CLOSED];
        } else {
            return $this->getData(self::QTY_CLOSED);
        }
        return $this->getData(self::QTY_CLOSED);
    }

    public function setQtyClosed($qty_closed)
    {
        $data = $this->getItemData();
        $data[self::QTY_CLOSED] = $qty_closed;
        $this->setItemData($data);
        return $this->setData(self::QTY_CLOSED, $qty_closed);
    }

    public function getQtyRefundRequested()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_REFUND_REQUESTED])) {
            return $data[self::QTY_REFUND_REQUESTED];
        } else {
            return $this->getData(self::QTY_REFUND_REQUESTED);
        }
        return $this->getData(self::QTY_REFUND_REQUESTED);
    }

    public function setQtyRefundRequested($qty_refund_requested)
    {
        $data = $this->getItemData();
        $data[self::QTY_REFUND_REQUESTED] = $qty_refund_requested;
        $this->setItemData($data);
        return $this->setData(self::QTY_REFUND_REQUESTED, $qty_refund_requested);
    }

    public function getQtyRefundReviewing()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_REFUND_REVIEWING])) {
            return $data[self::QTY_REFUND_REVIEWING];
        } else {
            return $this->getData(self::QTY_REFUND_REVIEWING);
        }
        return $this->getData(self::QTY_REFUND_REVIEWING);
    }

    public function setQtyRefundReviewing($qty_refund_reviewing)
    {
        $data = $this->getItemData();
        $data[self::QTY_REFUND_REVIEWING] = $qty_refund_reviewing;
        $this->setItemData($data);
        return $this->setData(self::QTY_REFUND_REVIEWING, $qty_refund_reviewing);
    }

    public function getQtyRefundApproved()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_REFUND_APPROVED])) {
            return $data[self::QTY_REFUND_APPROVED];
        } else {
            return $this->getData(self::QTY_REFUND_APPROVED);
        }
        return $this->getData(self::QTY_REFUND_APPROVED);
    }

    public function setQtyRefundApproved($qty_refund_approved)
    {
        $data = $this->getItemData();
        $data[self::QTY_REFUND_APPROVED] = $qty_refund_approved;
        $this->setItemData($data);
        return $this->setData(self::QTY_REFUND_APPROVED, $qty_refund_approved);
    }

    public function getQtyRefundRejected()
    {
        $data = $this->getItemData();
        if (isset($data[self::QTY_REFUND_REJECTED])) {
            return $data[self::QTY_REFUND_REJECTED];
        } else {
            return $this->getData(self::QTY_REFUND_REJECTED);
        }
        return $this->getData(self::QTY_REFUND_REJECTED);
    }

    public function setQtyRefundRejected($qty_refund_rejected)
    {
        $data = $this->getItemData();
        $data[self::QTY_REFUND_REJECTED] = $qty_refund_rejected;
        $this->setItemData($data);
        return $this->setData(self::QTY_REFUND_REJECTED, $qty_refund_rejected);
    }

    public function getItemData()
    {
        return empty($this->getData(self::DATA)) ? [] : json_decode($this->getData(self::DATA), true);
    }

    public function setItemData($data)
    {
        return $this->setData(self::DATA, json_encode($data));
    }

    public function addItemData($code, $value)
    {
        $data = $this->getItemData();
        $data[$code] = $value;
        $this->getItemData($data);
    }


}
