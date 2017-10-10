<?php


namespace Cleargo\Clearomni\Api;

interface OrderStatusManagementInterface
{


    /**
     * GET for orderStatus api
     * @param string $param
     * @return string
     */
    public function getOrderStatus($param);
}
