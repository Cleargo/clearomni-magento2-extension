<?php
namespace Cleargo\Clearomni\Model;

class CatalogrulepriceManagement implements \Cleargo\Clearomni\Api\CatalogrulepriceRepositoryInterface
{
    protected $searchResultsFactory;
/*
    public function __construct(
        \Cleargo\Clearomni\Api\Data\CatalogRuleProductPriceResultsInterface $searchResultsFactory
    ) {
        $this->searchResultsFactory = $searchResultsFactory;

    }*/


    /**
     * {@inheritdoc}
     */
    public function getCatalogRulePriceList()
    {
        //return rand(1,9999);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $select = $connection->select()
            ->from(
                ['sos' => 'catalogrule_product_price'],
                ['rule_product_price_id',
                    'rule_date',
                    'customer_group_id',
                    'product_id',
                    'rule_price',
                    'website_id',
                    'latest_start_date',
                    'earliest_end_date'
                ]
            )
        ;
        $data = $connection->fetchAll($select);

        return $data;
        // return 'hello api GET return the $param ' . $param;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria){

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $catalogRuleProductPrice = $objectManager->get("Magento\CatalogRule\Model\Rule\Product\Price");
        $collection = $catalogRuleProductPrice->getCollection();

        $this->searchResultsFactory = $objectManager->get("Magento\Framework\Api\SearchResultsInterface");

        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {

                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                if ($filter->getField() === 'sku') {
                    $condition = $filter->getConditionType() ?: 'eq';
                    $collection->getSelect()
                        ->joinLeft(array('product' => "catalog_product_entity"),
                            'product_id = product.entity_id',
                            array('sku' => 'sku')
                        );
                    $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
                    //echo $collection->getSelect();die();
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);

                //echo $collection->getSelect();die();
            }
        }

        /*foreach ($collection->getItems() as $item){
            \Zend_Debug::dump($item->debug());
        }
        die();*/
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        $searchResults = $this->searchResultsFactory;
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        //$searchResults->setItems($collection->getItems());

        $objects = [];
        foreach ($collection->getItems() as $objectModel) {
            if ($objectModel->getData('sku')){
                $objectModel->unsSku();
            }
            $objects[] = $objectModel->getData();
        }
        $searchResults->setItems($objects);


        return $searchResults;
    }
}
