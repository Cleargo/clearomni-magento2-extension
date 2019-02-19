<?php
namespace Cleargo\Clearomni\Model;

class CatalogrulepriceManagement
{

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
}
