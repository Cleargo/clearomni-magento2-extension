<?php


namespace Cleargo\Clearomni\Model\ResourceModel\OrderItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Cleargo\Clearomni\Model\OrderItem',
            'Cleargo\Clearomni\Model\ResourceModel\OrderItem'
        );
    }
}
