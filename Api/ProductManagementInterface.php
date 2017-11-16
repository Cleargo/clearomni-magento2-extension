<?php


namespace Cleargo\Clearomni\Api;

interface ProductManagementInterface
{


    /**
     * GET for product Info api
     * @param string $product_id
     * @return string
     */
    public function getInfo($product_id);
    
    /**
     * GET for product website_ids api
     * @param string $sku
     * @return string
     */
    public function getWebsiteIds($sku);
}
