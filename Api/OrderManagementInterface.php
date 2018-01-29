<?php


namespace Cleargo\Clearomni\Api;

interface OrderManagementInterface
{


    /**
     * POST for order api
     * @param string $param
     * @return string
     */
    public function postOrder($param);
    /**
     * POST for order api
     * @param string[] $param
     * @param \Cleargo\Clearomni\Api\Data\OrderItemInterface[] $items
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function updateOrder($param,$items);
}
