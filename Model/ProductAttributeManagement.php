<?php
namespace Cleargo\Clearomni\Model;

use Cleargo\Clearomni\Model\ResourceModel\ProductInfo\CollectionFactory;

class ProductAttributeManagement
{
    /**
     * {@inheritdoc}
     */
    public function getFrontendLabels($attribute_code)
    {
        $attribute_code = explode(',', $attribute_code);

        $_attribute_code = '';
        foreach ($attribute_code as $key => $code) {
            if( $key == 0 ) {
                $_attribute_code .= "'". $code ."'";
                // $_attribute_code .= $code;
            } else {
                $_attribute_code .= ",'". $code ."'";
                // $_attribute_code .= ",". $code;
            }            
        }
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $select = $connection->select()
            ->from(
                ['eav' => 'eav_attribute'],
                ['attribute_id', 'attribute_code']
            )
            ->join(
                ['eav_label' => 'eav_attribute_label'],
                'eav.attribute_id = eav_label.attribute_id',
                ['store_id', 'value']                         
            )
            ->where('eav.attribute_code in (?)', $attribute_code )
            // ->where('cpe.entity_id=?', $productId )
            ;
        $data = $connection->fetchAll($select);        

        foreach( $data as $key => $d ) {
            $data[$key]['locale'] = $this->_getStoreLocale($d['store_id']);            
        }

        return $data;
    }

    protected function _getStoreLocale($storeId) {
        /** @var \Magento\Framework\App\ObjectManager $obj */
        $obj = \Magento\Framework\App\ObjectManager::getInstance();

        //Get scope config
        // @var \Magento\Framework\App\Config\ScopeConfigInterface|\Magento\Framework\App\Config $scopeConfig 
        $scopeConfig = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface');

        return $scopeConfig->getValue('general/locale/code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }
}
