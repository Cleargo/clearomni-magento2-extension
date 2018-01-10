<?php


namespace Cleargo\Clearomni\Helper;


interface ClearomniHelperInterface
{

    public function getCartAvailableInStore($type);

    public function getProductAvailableInStore($productSku, $type = 'cnr');

    public function getProductAvailability($productId, $storeCode = false, $sku = false,$type='cnr');
}

?>