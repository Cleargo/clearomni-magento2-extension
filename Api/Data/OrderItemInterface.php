<?php


namespace Cleargo\Clearomni\Api\Data;

interface OrderItemInterface
{

    const QTY_CLEAROMNI_REFUNDED = 'qty_clearomni_refunded';
    const QTY_CLEAROMNI_RESERVED = 'qty_clearomni_reserved';
    const QTY_CLEAROMNI_EXCHANGE_REJECTED = 'qty_clearomni_exchange_rejected';
    const QTY_CLEAROMNI_EXCHANGE_SUCCESS = 'qty_clearomni_exchange_success';
    const ID = 'id';
    const ORDER_ID = 'order_id';
    const QTY_CLEAROMNI_TO_TRANSFER = 'qty_clearomni_to_transfer';
    const QTY_CLEAROMNI_COMPLETED = 'qty_clearomni_completed';
    const ORDER_ITEM_ID = 'order_item_id';
    const QTY_CLEAROMNI_CANCELLED = 'qty_clearomni_cancelled';
    const QTY_CLEAROMNI_READY_TO_PICK = 'qty_clearomni_ready_to_pick';
    const QTY_CLEAROMNI_STILL_CONSIDERING = 'qty_clearomni_still_considering';
    const QTY_CLEAROMNI_NOT_INTERESTING = 'qty_clearomni_not_interested';
    const QTY_CLEAROMNI_NO_SHOW = 'qty_clearomni_no_show';
    const QTY_CLEAROMNI_CLOSED = 'qty_clearomni_closed';
    const QTY_LENS_PRODUCTION = 'qty_lens_production';
    const QTY_OPTOM_RECEIVED = 'qty_optom_received';
    const QTY_PENDING_TRANSFER = 'qty_pending_transfer';
    const QTY_PICK_AND_PACK = 'qty_pick_and_pack';
    const QTY_READY_TO_SHIP = 'qty_ready_to_ship';
    const QTY_TO_FULFILMENT = 'qty_to_fulfilment';
    const QTY_TRANSFERRING_TO_OPTOM = 'qty_transferring_to_optom';
    const QTY_TRANSFERRING_TO_PICK = 'qty_transferring_to_pick';
    const QTY_TO_WAREHOUSE='qty_to_warehouse';
    const QTY_TO_PICKUP_STORE='qty_to_pickup_store';
    const QTY_COMPLETED='qty_completed';
    const QTY_CANCELLED='qty_cancelled';
    const QTY_CLOSED='qty_closed';
    const QTY_REFUND_REQUESTED='qty_refund_requested';
    const QTY_REFUND_REVIEWING='qty_refund_reviewing';
    const QTY_REFUND_APPROVED='qty_refund_approved';
    const QTY_REFUND_REJECTED='qty_refund_rejected';
    const DATA='item_data';



    /**
     * Get quoteitem_id
     * @return string|null
     */
    public function getId();

    /**
     * Set quoteitem_id
     * @param string $quoteitem_id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setId($id);

    /**
     * Get order_item_id
     * @return string|null
     */
    public function getOrderItemId();

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setOrderItemId($order_item_id);

    /**
     * Get order_id
     * @return string|null
     */
    public function getQuoteId();

    /**
     * Set order_id
     * @param string $order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQuoteId($order_id);

    /**
     * Get qty_clearomni_reserved
     * @return string|null
     */
    public function getQtyClearomniReserved();

    /**
     * Set qty_clearomni_reserved
     * @param string $qty_clearomni_reserved
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniReserved($qty_clearomni_reserved);

    /**
     * Get qty_clearomni_to_transfer
     * @return string|null
     */
    public function getQtyClearomniToTransfer();

    /**
     * Set qty_clearomni_to_transfer
     * @param string $qty_clearomni_to_transfer
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniToTransfer($qty_clearomni_to_transfer);

    /**
     * Get qty_clearomni_cancelled
     * @return string|null
     */
    public function getQtyClearomniCancelled();

    /**
     * Set qty_clearomni_cancelled
     * @param string $qty_clearomni_cancelled
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCancelled($qty_clearomni_cancelled);

    /**
     * Get qty_clearomni_completed
     * @return string|null
     */
    public function getQtyClearomniCompleted();

    /**
     * Set qty_clearomni_completed
     * @param string $qty_clearomni_completed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCompleted($qty_clearomni_completed);

    /**
     * Get qty_clearomni_refunded
     * @return string|null
     */
    public function getQtyClearomniRefunded();

    /**
     * Set qty_clearomni_refunded
     * @param string $qty_clearomni_refunded
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniRefunded($qty_clearomni_refunded);

    /**
     * Get qty_clearomni_exchange_success
     * @return string|null
     */
    public function getQtyClearomniExchangeSuccess();

    /**
     * Set qty_clearomni_exchange_success
     * @param string $qty_clearomni_exchange_success
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeSuccess($qty_clearomni_exchange_success);

    /**
     * Get qty_clearomni_exchange_rejected
     * @return string|null
     */
    public function getQtyClearomniExchangeRejected();

    /**
     * Set qty_clearomni_exchange_rejected
     * @param string $qty_clearomni_exchange_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeRejected($qty_clearomni_exchange_rejected);

    /**
     * Get qty_clearomni_ready_to_pick
     * @return string|null
     */
    public function getQtyClearomniReadyToPick();

    /**
     * Set qty_clearomni_ready_to_pick
     * @param string $qty_clearomni_exchange_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniReadyToPick($qty_clearomni_ready_to_pick);


    /**
     * Get qty_clearomni_still_considering
     * @return string|null
     */
    public function getQtyClearomniStillConsidering();

    /**
     * Set qty_clearomni_still_considering
     * @param string $qty_clearomni_still_considering
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniStillConsidering($qty_clearomni_still_considering);

    /**
     * Get qty_clearomni_not_interested
     * @return string|null
     */
    public function getQtyClearomniNotInterested();

    /**
     * Set qty_clearomni_not_interested
     * @param string $qty_clearomni_not_interested
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniNotInterested($qty_clearomni_not_interested);

    /**
     * Get qty_clearomni_no_show
     * @return string|null
     */
    public function getQtyClearomniNoShow();

    /**
     * Set qty_clearomni_no_show
     * @param string $qty_clearomni_no_show
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniNoShow($qty_clearomni_no_show);

    /**
     * Get qty_clearomni_closed
     * @return string|null
     */
    public function getQtyClearomniClosed();

    /**
     * Set qty_clearomni_closed
     * @param string $qty_clearomni_closed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniClosed($qty_clearomni_closed);

    /**
     * Get qty_lens_production
     * @return string|null
     */
    public function getQtyLensProduction();

    /**
     * Set qty_lens_production
     * @param string $qty_lens_production
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyLensProduction($qty_lens_production);

    /**
     * Get qty_optom_received
     * @return string|null
     */
    public function getQtyOptomReceived();

    /**
     * Set qty_optom_received
     * @param string $qty_optom_received
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyOptomReceived($qty_optom_received);

    /**
     * Get qty_pending_transfer
     * @return string|null
     */
    public function getQtyPendingTransfer();

    /**
     * Set qty_pending_transfer
     * @param string $qty_pending_transfer
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyPendingTransfer($qty_pending_transfer);

    /**
     * Get qty_pick_and_pack
     * @return string|null
     */
    public function getQtyPickAndPack();

    /**
     * Set qty_pick_and_pack
     * @param string $qty_pick_and_pack
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyPickAndPack($qty_pick_and_pack);

    /**
     * Get qty_ready_to_ship
     * @return string|null
     */
    public function getQtyReadyToShip();

    /**
     * Set qty_ready_to_ship
     * @param string $qty_ready_to_ship
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyReadyToShip($qty_ready_to_ship);

    /**
     * Get qty_to_fulfilment
     * @return string|null
     */
    public function getQtyToFulfilment();

    /**
     * Set qty_to_fulfilment
     * @param string $qty_to_fulfilment
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyToFulfilment($qty_to_fulfilment);

    /**
     * Get qty_transferring_to_optom
     * @return string|null
     */
    public function getQtyTransferringToOptom();

    /**
     * Set qty_transferring_to_optom
     * @param string $qty_transferring_to_optom
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyTransferringToOptom($qty_transferring_to_optom);

    /**
     * Get qty_transferring_to_pick
     * @return string|null
     */
    public function getQtyTransferringToPick();

    /**
     * Set qty_transferring_to_pick
     * @param string $qty_transferring_to_pick
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyTransferringToPick($qty_transferring_to_pick);

    /**
     * Get qty_to_warehouse
     * @return string|null
     */
    public function getQtyToWarehouse();

    /**
     * Set qty_to_warehouse
     * @param string $qty_to_warehouse
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyToWarehouse($qty_to_warehouse);

    /**
     * Get qty_to_pickup_store
     * @return string|null
     */
    public function getQtyToPickupStore();

    /**
     * Set qty_to_pickup_store
     * @param string $qty_to_pickup_store
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyToPickupStore($qty_to_pickup_store);

    /**
     * Get qty_completed
     * @return string|null
     */
    public function getQtyCompleted();

    /**
     * Set qty_completed
     * @param string $qty_completed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyCompleted($qty_completed);

    /**
     * Get qty_cancelled
     * @return string|null
     */
    public function getQtyCancelled();

    /**
     * Set qty_cancelled
     * @param string $qty_cancelled
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyCancelled($qty_cancelled);

    /**
     * Get qty_refund_requested
     * @return string|null
     */
    public function getQtyRefundRequested();

    /**
     * Set qty_refund_requested
     * @param string $qty_refund_requested
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyRefundRequested($qty_refund_requested);

    /**
     * Get qty_refund_reviewing
     * @return string|null
     */
    public function getQtyRefundReviewing();

    /**
     * Set qty_refund_reviewing
     * @param string $qty_refund_reviewing
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyRefundReviewing($qty_refund_reviewing);

    /**
     * Get qty_refund_approved
     * @return string|null
     */
    public function getQtyRefundApproved();

    /**
     * Set qty_refund_approved
     * @param string $qty_refund_approved
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyRefundApproved($qty_refund_approved);

    /**
     * Get qty_refund_rejected
     * @return string|null
     */
    public function getQtyRefundRejected();

    /**
     * Set qty_refund_rejected
     * @param string $qty_refund_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyRefundRejected($qty_refund_rejected);
    /**
     * Get data
     * @return string[]|null
     */
    public function getItemData();

    /**
     * Set data
     * @param string $qty_refund_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setItemData($qty_refund_rejected);

    /**
     * Set data
     * @param string $code
     * @param string $value
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function addItemData($code,$value);
}
