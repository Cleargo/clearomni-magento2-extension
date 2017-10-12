<?php
namespace Cleargo\Clearomni\Model;

use Cleargo\Clearomni\Model\ResourceModel\ProductInfo\CollectionFactory;

class ProductManagement
{
    /** @var SearchCriteriaBuilder */
    protected $collectionFactory;

    /**
     * Initialize dependencies.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct( CollectionFactory $collectionFactory ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getInfo($product_id)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $select = $connection->select()
                ->from(
                    ['cpe' => 'catalog_product_entity'],
                    ['entity_id', 'sku']
                )
                ->join(
                    ['cpe_varchar' => 'catalog_product_entity_varchar'],
                    'cpe_varchar.row_id = cpe.entity_id',
                    ['attribute_id', 'store_id', 'value']                         
                )->columns('cpe_varchar.attribute_id')
                ->join(
                    ['eav' => 'eav_attribute'],
                    'eav.attribute_id = cpe_varchar.attribute_id',
                    ['attribute_code']                         
                )
                ->where('eav.attribute_code=\'name\' AND cpe.entity_id=?', $product_id )
                // ->where('cpe.entity_id=?', $productId )
                ;

        $data = $connection->fetchAll($select);

        return $data;
    }

    public function getWebsiteIds($product_id) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $select = $connection->select()
                ->from(
                    ['cpw' => 'catalog_product_website'],
                    ['product_id', 'website_id']
                )                
                ->where('cpw.product_id=?', $product_id )
                ;

        $data = $connection->fetchAll($select);

        $ret = [];

        foreach ($data as $key => $d) {
            # code...
            $ret[] = $d['website_id'];
        }
        return $ret;
        // return 'hello getWebsiteIds';
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
