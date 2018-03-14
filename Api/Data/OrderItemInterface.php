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
}
