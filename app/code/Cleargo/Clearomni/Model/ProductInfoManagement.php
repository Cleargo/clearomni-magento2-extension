<?php
namespace Cleargo\Clearomni\Model;

use Cleargo\Clearomni\Model\ResourceModel\ProductInfo\CollectionFactory;

class ProductInfoManagement
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
    public function getProductInfo($productId)
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
                ->where('eav.attribute_code=\'name\' AND cpe.entity_id=?', $productId )
                // ->where('cpe.entity_id=?', $productId )
                ;

        $data = $connection->fetchAll($select);

        // $result = [];
        // $productName = [];

        // foreach( $data as $d ) {
        //     $productName[] = [ 
        //         'store_id' => $d
        //         , 'frontend_label' => $d['value']
        //     ]
        // }

        return $data;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);   
        $product_websites = $product->getWebsiteIds();

        $stores = [];
        
        foreach( $this->getListStores() as $store ) {
            $store['product_name'] = $product->setStoreId($store['store_id'])->getName();
            $stores[] = $store;
        }

        return json_encode($stores);

        $result = array(
            'result' => $product->getName()
            , 'website_id' => $product->getWebsiteIds()
            , 'frontend_labels' => $product->getStoreLabel()
            , 'stores' => $stores
        );
        // return 'test';
        return json_encode($result);
    }

    public function getListStores() {
        // $stores = $storeRepo->getList();
     //    $websiteIds = array();
     //    $storeList = array();
     //    foreach ($stores as $store) {
     //        $websiteId = $store["website_id"];
     //        $storeId = $store["store_id"];
     //        $storeName = $store["name"];
     //        $storeList[$storeId] = $storeName;
     //        array_push($websiteIds, $websiteId);
     //    }
     //    return $storeList;

        /** @var \Magento\Framework\App\ObjectManager $obj */
        $obj = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Store\Model\StoreManagerInterface|\Magento\Store\Model\StoreManager $storeManager */
        $storeManager = $obj->get('Magento\Store\Model\StoreManagerInterface');
        $stores = $storeManager->getStores($withDefault = false);

        //Locale code
        $locale = [];
        $eachStore = [];
        //Try to get list of locale for all stores;
        foreach($stores as $store) {
            $eachStore[] = array(
                'website_id' => $store["website_id"]
                , 'store_id' => $store["store_id"]
                , 'store_name' => $store["name"]
                // , 'locale' => $scopeConfig->getValue('general/locale/code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store->getStoreId())
                , 'locale' => $this->_getStoreLocale($store->getStoreId())
                // , 'storeList'[$storeId] = $storeName;
                // , 'storeList'[$storeId] = $storeName;
            );
            //        array_push($websiteIds, $websiteId);
        }

        return $eachStore;
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
