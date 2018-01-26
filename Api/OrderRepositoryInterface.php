<?php


namespace Cleargo\Clearomni\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface OrderRepositoryInterface
{


    /**
     * Save Order
     * @param \Cleargo\Clearomni\Api\Data\OrderInterface $order
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Cleargo\Clearomni\Api\Data\OrderInterface $order
    );

    /**
     * Retrieve Order
     * @param string $orderId
     * @return \Cleargo\Clearomni\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($orderId);

    /**
     * Retrieve Order matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Cleargo\Clearomni\Api\Data\OrderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Order
     * @param \Cleargo\Clearomni\Api\Data\OrderInterface $order
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Cleargo\Clearomni\Api\Data\OrderInterface $order
    );

    /**
     * Delete Order by ID
     * @param string $orderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($orderId);
}
