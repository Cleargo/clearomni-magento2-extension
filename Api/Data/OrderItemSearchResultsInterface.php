<?php


namespace Cleargo\Clearomni\Api\Data;

interface OrderItemSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get OrderItem list.
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface[]
     */
    public function getItems();

    /**
     * Set order_item_id list.
     * @param \Cleargo\Clearomni\Api\Data\OrderItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
