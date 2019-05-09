<?php


namespace Tychons\Storeorder\Model\ResourceModel;

class Scheduler extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tychons_storeorder_scheduler', 'scheduler_id');
    }
}
