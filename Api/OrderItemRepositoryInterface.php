<?php


namespace Cleargo\Clearomni\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface OrderItemRepositoryInterface
{


    /**
     * Save OrderItem
     * @param \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
    );

    /**
     * Retrieve OrderItem
     * @param string $id
     * @return \Cleargo\Clearomni\Api\Data\OrderItemInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve OrderItem matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Cleargo\Clearomni\Api\Data\OrderItemSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete OrderItem
     * @param \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
    );

    /**
     * Delete OrderItem by ID
     * @param string $quoteitemId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($quoteitemId);
}
