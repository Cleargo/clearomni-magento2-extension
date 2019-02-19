<?php
namespace Cleargo\Clearomni\Api;

interface CatalogrulepriceRepositoryInterface
{
    /**
     * Returns table catalogrule_product_price
     *
     * @api
     * @param string
     * @return array
     */
    public function getCatalogRulePriceList();
}