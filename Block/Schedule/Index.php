<?php


namespace Tychons\Storeorder\Block\Schedule;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getSchedules()
    {
            $objectmanager = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
            $connection= $objectmanager->getConnection();

            $table = $objectmanager->getTableName('tychons_storeorder_scheduler');
            $sql = "SELECT * FROM " . $table;
            
            $data = $connection->fetchAll($sql);

            return $data[0];
    }
}
