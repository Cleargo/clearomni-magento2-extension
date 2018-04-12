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
        if($comment=='Adyen Payment Successfully completed'){
            $this->requestHelper->request('/get-order/'.$subject->getId());
        }
        return $result;
    }
}