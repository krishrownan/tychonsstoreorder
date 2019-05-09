<?php

namespace Tychons\Storeorder\Model\ResourceModel\StoreProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Tychons\Storeorder\Model\StoreProduct::class,
            \Tychons\Storeorder\Model\ResourceModel\StoreProduct::class
        );
    }
}