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
     * @return \Cleargo\Clearomni\Api\Data\ApiResultInterface
     */
    public function updateOrder($param);
}
