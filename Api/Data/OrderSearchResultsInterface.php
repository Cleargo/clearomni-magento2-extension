<?php


namespace Cleargo\Clearomni\Api\Data;

interface OrderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Order list.
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface[]
     */
    public function getItems();

    /**
     * Set staff_code list.
     * @param \Cleargo\Clearomni\Api\Data\OrderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
