<?php


namespace Cleargo\Clearomni\Api\Data;

interface OrderInterface
{

    const STAFF_CODE = 'staff_code';
    const PICKUP_STORE_CLEAROMNI_ID = 'pickup_store_clearomni_id';
    const ORDER_ID = 'order_id';
    const PICKUP_STORE_LABEL = 'pickup_store_label';
    const MAGNETO_ORDER_ID = 'magento_order_id';
    const PICKUP_STORE = 'pickup_store';
    const CLEAROMNI_REMARKS = 'clearomni_remarks';
    const VISITING_DATE = 'visiting_date';
    const VISITING_HOUR = 'visiting_hour';


    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setOrderId($orderId);

    /**
     * Get staff_code
     * @return string|null
     */
    public function getStaffCode();

    /**
     * Set staff_code
     * @param string $staff_code
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setStaffCode($staff_code);

    /**
     * Get clearomni_remarks
     * @return string|null
     */
    public function getClearomniRemarks();

    /**
     * Set clearomni_remarks
     * @param string $clearomni_remarks
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setClearomniRemarks($clearomni_remarks);

    /**
     * Get pickup_store
     * @return string|null
     */
    public function getPickupStore();

    /**
     * Set pickup_store
     * @param string $pickup_store
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStore($pickup_store);

    /**
     * Get pickup_store_label
     * @return string|null
     */
    public function getPickupStoreLabel();

    /**
     * Set pickup_store_label
     * @param string $pickup_store_label
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreLabel($pickup_store_label);

    /**
     * Get pickup_store_clearomni_id
     * @return string|null
     */
    public function getPickupStoreClearomniId();

    /**
     * Set pickup_store_clearomni_id
     * @param string $pickup_store_clearomni_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreClearomniId($pickup_store_clearomni_id);

    /**
     * Get magento_order_id
     * @return string|null
     */
    public function getMagentoOrderId();

    /**
     * Set magento_order_id
     * @param string $magento_order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setMagentoOrderId($magento_order_id);

    /**
     * Get visiting_date
     * @return string|null
     */
    public function getVisitingDate();

    /**
     * Set visiting_date
     * @param string $visiting_date
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingDate($visiting_date);

    /**
     * Get visiting_hour
     * @return string|null
     */
    public function getVisitingHour();

    /**
     * Set visiting_hour
     * @param string $visiting_hour
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingHour($visiting_hour);
}
