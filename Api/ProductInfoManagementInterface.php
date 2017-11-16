<?php


namespace Cleargo\Clearomni\Api;

interface ProductInfoManagementInterface
{


    /**
     * GET for productInfo api
     * @param string $param
     * @return string
     */
    public function getProductInfo($product_id);
}
