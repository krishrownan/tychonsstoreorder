<?php


namespace Tychons\Storeorder\Model\ResourceModel\Scheduler;

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
            \Tychons\Storeorder\Model\Scheduler::class,
            \Tychons\Storeorder\Model\ResourceModel\Scheduler::class
        );
    }
}
