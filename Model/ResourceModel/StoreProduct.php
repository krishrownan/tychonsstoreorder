<?php

namespace Tychons\Storeorder\Model\ResourceModel;

class StoreProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tychons_storeorder_product', 'storeproduct_id');
    }
}