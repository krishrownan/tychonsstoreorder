<?php


namespace Tychons\Storeorder\Model;

use Magento\Framework\Api\DataObjectHelper;
use Tychons\Storeorder\Api\Data\SchedulerInterface;
use Tychons\Storeorder\Api\Data\SchedulerInterfaceFactory;

class Scheduler extends \Magento\Framework\Model\AbstractModel
{

    protected $schedulerDataFactory;

    protected $_eventPrefix = 'tychons_storeorder_scheduler';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param SchedulerInterfaceFactory $schedulerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Tychons\Storeorder\Model\ResourceModel\Scheduler $resource
     * @param \Tychons\Storeorder\Model\ResourceModel\Scheduler\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SchedulerInterfaceFactory $schedulerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Tychons\Storeorder\Model\ResourceModel\Scheduler $resource,
        \Tychons\Storeorder\Model\ResourceModel\Scheduler\Collection $resourceCollection,
        array $data = []
    ) {
        $this->schedulerDataFactory = $schedulerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve scheduler model with scheduler data
     * @return SchedulerInterface
     */
    public function getDataModel()
    {
        $schedulerData = $this->getData();
        
        $schedulerDataObject = $this->schedulerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $schedulerDataObject,
            $schedulerData,
            SchedulerInterface::class
        );
        
        return $schedulerDataObject;
    }
}
