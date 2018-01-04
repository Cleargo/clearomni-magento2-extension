<?php


namespace Cleargo\Clearomni\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Cleargo\Clearomni\Model\ResourceModel\OrderItem as ResourceOrderItem;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SortOrder;
use Cleargo\Clearomni\Api\OrderItemRepositoryInterface;
use Cleargo\Clearomni\Model\ResourceModel\OrderItem\CollectionFactory as OrderItemCollectionFactory;
use Cleargo\Clearomni\Api\Data\OrderItemSearchResultsInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Cleargo\Clearomni\Api\Data\OrderItemInterfaceFactory;

class OrderItemRepository implements OrderItemRepositoryInterface
{

    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    protected $quoteItemFactory;

    protected $searchResultsFactory;

    protected $resource;

    protected $quoteItemCollectionFactory;

    protected $dataOrderItemFactory;

    private $storeManager;


    /**
     * @param ResourceOrderItem $resource
     * @param OrderItemFactory $quoteItemFactory
     * @param OrderItemInterfaceFactory $dataOrderItemFactory
     * @param OrderItemCollectionFactory $quoteItemCollectionFactory
     * @param OrderItemSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceOrderItem $resource,
        OrderItemFactory $quoteItemFactory,
        OrderItemInterfaceFactory $dataOrderItemFactory,
        OrderItemCollectionFactory $quoteItemCollectionFactory,
        OrderItemSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->quoteItemFactory = $quoteItemFactory;
        $this->quoteItemCollectionFactory = $quoteItemCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataOrderItemFactory = $dataOrderItemFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
    ) {
        /* if (empty($quoteItem->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $quoteItem->setStoreId($storeId);
        } */
        try {
            $quoteItem->getResource()->save($quoteItem);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the quoteItem: %1',
                $exception->getMessage()
            ));
        }
        return $quoteItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($quoteItemId)
    {
        $quoteItem = $this->quoteItemFactory->create();
        $quoteItem->getResource()->load($quoteItem, $quoteItemId);
        if (!$quoteItem->getId()) {
            throw new NoSuchEntityException(__('OrderItem with id "%1" does not exist.', $quoteItemId));
        }
        return $quoteItem;
    }
    public function getByItemId($quoteItemId)
    {
        $quoteItem = $this->quoteItemFactory->create();
        $quoteItem->getResource()->load($quoteItem,$quoteItemId,'order_item_id');
        if (!$quoteItem->getId()) {
            throw new NoSuchEntityException(__('OrderItem with order_item_id "%1" does not exist.', $quoteItemId));
        }
        return $quoteItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->quoteItemCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Cleargo\Clearomni\Api\Data\OrderItemInterface $quoteItem
    ) {
        try {
            $quoteItem->getResource()->delete($quoteItem);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the OrderItem: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($quoteItemId)
    {
        return $this->delete($this->getById($quoteItemId));
    }
}
