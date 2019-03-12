<?php
namespace Cleargo\Clearomni\Api\Data;

interface CatalogRuleProductPriceResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Cleargo\Clearomni\Api\CatalogrulepriceRepositoryInterface[]
     */
    public function getItems();

    /**
     * @param \Cleargo\Clearomni\Api\CatalogrulepriceRepositoryInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}