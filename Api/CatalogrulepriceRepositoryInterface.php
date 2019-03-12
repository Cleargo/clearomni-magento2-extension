<?php
namespace Cleargo\Clearomni\Api;

interface CatalogrulepriceRepositoryInterface
{
    /**
     * Returns table catalogrule_product_price
     *
     * @api
     * @param string
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getCatalogRulePriceList();

    /**
     * Returns table catalogrule_product_price
     *
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList( \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}