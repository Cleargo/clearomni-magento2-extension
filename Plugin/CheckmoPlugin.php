<?php

namespace Cleargo\Clearomni\Plugin;

class CheckmoPlugin
{


    public function __construct(
    )
    {
    }

    //check inv first
    public function afterCanRefund($subject,$result){
        return true;
    }

}