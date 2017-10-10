<?php


namespace Cleargo\Clearomni\Api;

interface ProductAttributeManagementInterface
{


    /**
     * GET for productInfo api
     * @param string $param
     * @return string
     */
    public function getFrontendLabel($attribute_code);
}
