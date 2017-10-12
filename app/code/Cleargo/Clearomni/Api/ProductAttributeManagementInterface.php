<?php


namespace Cleargo\Clearomni\Api;

interface ProductAttributeManagementInterface
{


    /**
     * GET for productInfo api
     * @param string $param
     * @return string
     */
    public function getFrontendLabels($attribute_code);
}
