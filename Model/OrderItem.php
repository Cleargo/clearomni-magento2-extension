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
        return $this->setData(self::ORDER_ID, $order_id);
    }

    /**
     * Get qty_clearomni_reserved
     * @return string
     */
    public function getQtyClearomniReserved()
    {
        return $this->getData(self::QTY_CLEAROMNI_RESERVED);
    }

    /**
     * Set qty_clearomni_reserved
     * @param string $qty_clearomni_reserved
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniReserved($qty_clearomni_reserved)
    {
        return $this->setData(self::QTY_CLEAROMNI_RESERVED, $qty_clearomni_reserved);
    }

    /**
     * Get qty_clearomni_to_transfer
     * @return string
     */
    public function getQtyClearomniToTransfer()
    {
        return $this->getData(self::QTY_CLEAROMNI_TO_TRANSFER);
    }

    /**
     * Set qty_clearomni_to_transfer
     * @param string $qty_clearomni_to_transfer
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniToTransfer($qty_clearomni_to_transfer)
    {
        return $this->setData(self::QTY_CLEAROMNI_TO_TRANSFER, $qty_clearomni_to_transfer);
    }

    /**
     * Get qty_clearomni_cancelled
     * @return string
     */
    public function getQtyClearomniCancelled()
    {
        return $this->getData(self::QTY_CLEAROMNI_CANCELLED);
    }

    /**
     * Set qty_clearomni_cancelled
     * @param string $qty_clearomni_cancelled
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCancelled($qty_clearomni_cancelled)
    {
        return $this->setData(self::QTY_CLEAROMNI_CANCELLED, $qty_clearomni_cancelled);
    }

    /**
     * Get qty_clearomni_completed
     * @return string
     */
    public function getQtyClearomniCompleted()
    {
        return $this->getData(self::QTY_CLEAROMNI_COMPLETED);
    }

    /**
     * Set qty_clearomni_completed
     * @param string $qty_clearomni_completed
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniCompleted($qty_clearomni_completed)
    {
        return $this->setData(self::QTY_CLEAROMNI_COMPLETED, $qty_clearomni_completed);
    }

    /**
     * Get qty_clearomni_refunded
     * @return string
     */
    public function getQtyClearomniRefunded()
    {
        return $this->getData(self::QTY_CLEAROMNI_REFUNDED);
    }

    /**
     * Set qty_clearomni_refunded
     * @param string $qty_clearomni_refunded
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniRefunded($qty_clearomni_refunded)
    {
        return $this->setData(self::QTY_CLEAROMNI_REFUNDED, $qty_clearomni_refunded);
    }

    /**
     * Get qty_clearomni_exchange_success
     * @return string
     */
    public function getQtyClearomniExchangeSuccess()
    {
        return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_SUCCESS);
    }

    /**
     * Set qty_clearomni_exchange_success
     * @param string $qty_clearomni_exchange_success
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeSuccess($qty_clearomni_exchange_success)
    {
        return $this->setData(self::QTY_CLEAROMNI_EXCHANGE_SUCCESS, $qty_clearomni_exchange_success);
    }

    /**
     * Get qty_clearomni_exchange_rejected
     * @return string
     */
    public function getQtyClearomniExchangeRejected()
    {
        return $this->getData(self::QTY_CLEAROMNI_EXCHANGE_REJECTED);
    }

    /**
     * Set qty_clearomni_exchange_rejected
     * @param string $qty_clearomni_exchange_rejected
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     */
    public function setQtyClearomniExchangeRejected($qty_clearomni_exchange_rejected)
    {
        return $this->setData(self::QTY_CLEAROMNI_EXCHANGE_REJECTED, $qty_clearomni_exchange_rejected);
    }
}
