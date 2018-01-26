<?php


namespace Cleargo\Clearomni\Model\ResourceModel;

class Order extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cleargo_clearomni_order', 'order_id');
    }
}
