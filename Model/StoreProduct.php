<?php

namespace Tychons\Storeorder\Model;

use Magento\Framework\Api\DataObjectHelper;
use Tychons\Storeorder\Api\Data\StoreProductInterface;
use Tychons\Storeorder\Api\Data\StoreProductInterfaceFactory;

class StoreProduct extends \Magento\Framework\Model\AbstractModel
{

    protected $storeproductDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'tychons_storeorder_storeproduct';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param StoreProductInterfaceFactory $storeproductDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Tychons\Storeorder\Model\ResourceModel\StoreProduct $resource
     * @param \Tychons\Storeorder\Model\ResourceModel\StoreProduct\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StoreProductInterfaceFactory $storeproductDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Tychons\Storeorder\Model\ResourceModel\StoreProduct $resource,
        \Tychons\Storeorder\Model\ResourceModel\StoreProduct\Collection $resourceCollection,
        array $data = []
    ) {
        $this->storeproductDataFactory = $storeproductDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve storeproduct model with storeproduct data
     * @return StoreProductInterface
     */
    public function getDataModel()
    {
        $storeproductData = $this->getData();
        
        $storeproductDataObject = $this->storeproductDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $storeproductDataObject,
            $storeproductData,
            StoreProductInterface::class
        );
        
        return $storeproductDataObject;
    }
}