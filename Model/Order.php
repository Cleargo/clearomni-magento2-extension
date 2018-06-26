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
        $data = $this->getItemData();
        $data[self::ORDER_ID] = $orderId;
        $this->getItemData($data);
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get staff_code
     * @return string
     */
    public function getStaffCode()
    {
        $data = $this->getItemData();
        if (isset($data[self::STAFF_CODE])) {
            return $data[self::STAFF_CODE];
        } else {
            return $this->getData(self::STAFF_CODE);
        }
        return $this->getData(self::STAFF_CODE);
    }

    /**
     * Set staff_code
     * @param string $staff_code
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setStaffCode($staff_code)
    {
        $data = $this->getItemData();
        $data[self::STAFF_CODE] = $staff_code;
        $this->getItemData($data);
        return $this->setData(self::STAFF_CODE, $staff_code);
    }

    /**
     * Get clearomni_remarks
     * @return string
     */
    public function getClearomniRemarks()
    {
        $data = $this->getItemData();
        if (isset($data[self::CLEAROMNI_REMARKS])) {
            return $data[self::CLEAROMNI_REMARKS];
        } else {
            return $this->getData(self::CLEAROMNI_REMARKS);
        }
        return $this->getData(self::CLEAROMNI_REMARKS);
    }

    /**
     * Set clearomni_remarks
     * @param string $clearomni_remarks
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setClearomniRemarks($clearomni_remarks)
    {
        $data = $this->getItemData();
        $data[self::CLEAROMNI_REMARKS] = $clearomni_remarks;
        $this->getItemData($data);
        return $this->setData(self::CLEAROMNI_REMARKS, $clearomni_remarks);
    }

    /**
     * Get pickup_store
     * @return string
     */
    public function getPickupStore()
    {
        $data = $this->getItemData();
        if (isset($data[self::PICKUP_STORE])) {
            return $data[self::PICKUP_STORE];
        } else {
            return $this->getData(self::PICKUP_STORE);
        }
        return $this->getData(self::PICKUP_STORE);
    }

    /**
     * Set pickup_store
     * @param string $pickup_store
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStore($pickup_store)
    {
        $data = $this->getItemData();
        $data[self::PICKUP_STORE] = $pickup_store;
        $this->getItemData($data);
        return $this->setData(self::PICKUP_STORE, $pickup_store);
    }

    /**
     * Get pickup_store_label
     * @return string
     */
    public function getPickupStoreLabel()
    {
        $data = $this->getItemData();
        if (isset($data[self::PICKUP_STORE_LABEL])) {
            return $data[self::PICKUP_STORE_LABEL];
        } else {
            return $this->getData(self::PICKUP_STORE_LABEL);
        }
        return $this->getData(self::PICKUP_STORE_LABEL);
    }

    /**
     * Set pickup_store_label
     * @param string $pickup_store_label
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreLabel($pickup_store_label)
    {
        $data = $this->getItemData();
        $data[self::PICKUP_STORE_LABEL] = $pickup_store_label;
        $this->getItemData($data);
        return $this->setData(self::PICKUP_STORE_LABEL, $pickup_store_label);
    }

    /**
     * Get pickup_store_clearomni_id
     * @return string
     */
    public function getPickupStoreClearomniId()
    {
        $data = $this->getItemData();
        if (isset($data[self::PICKUP_STORE_CLEAROMNI_ID])) {
            return $data[self::PICKUP_STORE_CLEAROMNI_ID];
        } else {
            return $this->getData(self::PICKUP_STORE_CLEAROMNI_ID);
        }
        return $this->getData(self::PICKUP_STORE_CLEAROMNI_ID);
    }

    /**
     * Set pickup_store_clearomni_id
     * @param string $pickup_store_clearomni_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setPickupStoreClearomniId($pickup_store_clearomni_id)
    {
        $data = $this->getItemData();
        $data[self::PICKUP_STORE_CLEAROMNI_ID] = $pickup_store_clearomni_id;
        $this->getItemData($data);
        return $this->setData(self::PICKUP_STORE_CLEAROMNI_ID, $pickup_store_clearomni_id);
    }

    /**
     * Get magento_order_id
     * @return string
     */
    public function getMagentoOrderId()
    {
        $data = $this->getItemData();
        if (isset($data[self::MAGNETO_ORDER_ID])) {
            return $data[self::MAGNETO_ORDER_ID];
        } else {
            return $this->getData(self::MAGNETO_ORDER_ID);
        }
        return $this->getData(self::MAGNETO_ORDER_ID);
    }

    /**
     * Set magento_order_id
     * @param string $magento_order_id
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setMagentoOrderId($magento_order_id)
    {
        $data = $this->getItemData();
        $data[self::MAGNETO_ORDER_ID] = $magento_order_id;
        $this->getItemData($data);
        return $this->setData(self::MAGNETO_ORDER_ID, $magento_order_id);
    }

    /**
     * Get visiting_date
     * @return string
     */
    public function getVisitingDate()
    {
        $data = $this->getItemData();
        if (isset($data[self::VISITING_DATE])) {
            return $data[self::VISITING_DATE];
        } else {
            return $this->getData(self::VISITING_DATE);
        }
        return $this->getData(self::VISITING_DATE);
    }

    /**
     * Set visiting_date
     * @param string $visiting_date
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingDate($visiting_date)
    {
        $data = $this->getItemData();
        $data[self::VISITING_DATE] = $visiting_date;
        $this->getItemData($data);
        return $this->setData(self::VISITING_DATE, $visiting_date);
    }

    /**
     * Get visiting_hour
     * @return string
     */
    public function getVisitingHour()
    {
        $data = $this->getItemData();
        if (isset($data[self::VISITING_HOUR])) {
            return $data[self::VISITING_HOUR];
        } else {
            return $this->getData(self::VISITING_HOUR);
        }
    }

    /**
     * Set visiting_hour
     * @param string $visiting_hour
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     */
    public function setVisitingHour($visiting_hour)
    {
        $data = $this->getItemData();
        $data[self::VISITING_HOUR] = $visiting_hour;
        $this->getItemData($data);
        return $this->setData(self::VISITING_HOUR, $visiting_hour);
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
