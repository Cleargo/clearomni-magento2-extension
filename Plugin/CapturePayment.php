<?php

namespace Cleargo\Clearomni\Plugin;

class CapturePayment
{
    /**
     * @var \Cleargo\Clearomni\Helper\Request
     */
    protected $requestHelper;

    public function __construct(
        \Cleargo\Clearomni\Helper\Request $requestHelper
    )
    {
        $this->requestHelper=$requestHelper;
    }

    public function afterAddStatusHistoryComment(
        $subject,
        $result
    )
    {
        $comment=$result->getComment();
        $connection = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection')->getConnection();
        $query=$connection->prepare('insert into cleargo_clearomni_api_log set request_url=?,request_body=?,response_body=?,response_code=?,`date`=?,`debug`=?');
        $query->bindValue(1,'afterAddStatusHistoryComment');
        $query->bindValue(2,$subject->getId());
        $query->bindValue(3,$comment);
        $query->bindValue(4,$comment);
        $query->bindValue(5,date('d-m-Y H:i:s'));
        $query->bindValue(6,json_encode(debug_backtrace()));
        $query->execute();
        if($comment=='Adyen Payment Successfully completed'||$comment=='Payment is authorised waiting for capture'){
            $subject->setState('processing');
            $subject->save();
            $this->requestHelper->request('/get-order/'.$subject->getId());
        }
        return $result;
    }
}