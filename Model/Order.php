<?php


namespace Cleargo\Clearomni\Model;

use Cleargo\Clearomni\Api\Data\OrderInterface;

class Order extends \Magento\Framework\Model\AbstractModel implements OrderInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cleargo\Clearomni\Model\ResourceModel\Order');
    }

    /**
     * Get order_id
     * @return string
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get staff_code
     * @return string
     */
    public function getStaffCode()
    {
        return $this->getData(self::STAFF_CODE);
    }

    /**
     * Set staff_code
     * @param string $staff_code
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setStaffCode($staff_code)
    {
        return $this->setData(self::STAFF_CODE, $staff_code);
    }

    /**
     * Get clearomni_remarks
     * @return string
     */
    public function getClearomniRemarks()
    {
        return $this->getData(self::CLEAROMNI_REMARKS);
    }

    /**
     * Set clearomni_remarks
     * @param string $clearomni_remarks
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setClearomniRemarks($clearomni_remarks)
    {
        return $this->setData(self::CLEAROMNI_REMARKS, $clearomni_remarks);
    }

    /**
     * Get pickup_store
     * @return string
     */
    public function getPickupStore()
    {
        return $this->getData(self::PICKUP_STORE);
    }

    /**
     * Set pickup_store
     * @param string $pickup_store
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStore($pickup_store)
    {
        return $this->setData(self::PICKUP_STORE, $pickup_store);
    }

    /**
     * Get pickup_store_label
     * @return string
     */
    public function getPickupStoreLabel()
    {
        return $this->getData(self::PICKUP_STORE_LABEL);
    }

    /**
     * Set pickup_store_label
     * @param string $pickup_store_label
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreLabel($pickup_store_label)
    {
        return $this->setData(self::PICKUP_STORE_LABEL, $pickup_store_label);
    }

    /**
     * Get pickup_store_clearomni_id
     * @return string
     */
    public function getPickupStoreClearomniId()
    {
        return $this->getData(self::PICKUP_STORE_CLEAROMNI_ID);
    }

    /**
     * Set pickup_store_clearomni_id
     * @param string $pickup_store_clearomni_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreClearomniId($pickup_store_clearomni_id)
    {
        return $this->setData(self::PICKUP_STORE_CLEAROMNI_ID, $pickup_store_clearomni_id);
    }

    /**
     * Get magento_order_id
     * @return string
     */
    public function getMagentoOrderId()
    {
        return $this->getData(self::MAGNETO_ORDER_ID);
    }

    /**
     * Set magento_order_id
     * @param string $magento_order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setMagentoOrderId($magento_order_id)
    {
        return $this->setData(self::MAGNETO_ORDER_ID, $magento_order_id);
    }

    /**
     * Get visiting_date
     * @return string
     */
    public function getVisitingDate()
    {
        return $this->getData(self::VISITING_DATE);
    }

    /**
     * Set visiting_date
     * @param string $visiting_date
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingDate($visiting_date)
    {
        return $this->setData(self::VISITING_DATE, $visiting_date);
    }

    /**
     * Get visiting_hour
     * @return string
     */
    public function getVisitingHour()
    {
        return $this->getData(self::VISITING_HOUR);
    }

    /**
     * Set visiting_hour
     * @param string $visiting_hour
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingHour($visiting_hour)
    {
        return $this->setData(self::VISITING_HOUR, $visiting_hour);
    }
}
