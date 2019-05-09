<?php


namespace Tychons\Storeorder\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\NoSuchEntityException;
use Tychons\Storeorder\Model\ResourceModel\StoreProduct\CollectionFactory as StoreProductCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Tychons\Storeorder\Api\Data\StoreProductSearchResultsInterfaceFactory;
use Tychons\Storeorder\Model\ResourceModel\StoreProduct as ResourceStoreProduct;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Tychons\Storeorder\Api\StoreProductRepositoryInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Tychons\Storeorder\Api\Data\StoreProductInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class StoreProductRepository implements StoreProductRepositoryInterface
{

    protected $dataObjectHelper;

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    protected $storeProductCollectionFactory;

    protected $dataStoreProductFactory;

    private $storeManager;

    protected $storeProductFactory;


    /**
     * @param ResourceStoreProduct $resource
     * @param StoreProductFactory $storeProductFactory
     * @param StoreProductInterfaceFactory $dataStoreProductFactory
     * @param StoreProductCollectionFactory $storeProductCollectionFactory
     * @param StoreProductSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceStoreProduct $resource,
        StoreProductFactory $storeProductFactory,
        StoreProductInterfaceFactory $dataStoreProductFactory,
        StoreProductCollectionFactory $storeProductCollectionFactory,
        StoreProductSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->storeProductFactory = $storeProductFactory;
        $this->storeProductCollectionFactory = $storeProductCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataStoreProductFactory = $dataStoreProductFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
    ) {
        /* if (empty($storeProduct->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $storeProduct->setStoreId($storeId);
        } */
        
        $storeProductData = $this->extensibleDataObjectConverter->toNestedArray(
            $storeProduct,
            [],
            \Tychons\Storeorder\Api\Data\StoreProductInterface::class
        );
        
        $storeProductModel = $this->storeProductFactory->create()->setData($storeProductData);
        
        try {
            $this->resource->save($storeProductModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the storeProduct: %1',
                $exception->getMessage()
            ));
        }
        return $storeProductModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($storeProductId)
    {
        $storeProduct = $this->storeProductFactory->create();
        $this->resource->load($storeProduct, $storeProductId);
        if (!$storeProduct->getId()) {
            throw new NoSuchEntityException(__('StoreProduct with id "%1" does not exist.', $storeProductId));
        }
        return $storeProduct->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->storeProductCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Tychons\Storeorder\Api\Data\StoreProductInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
    ) {
        try {
            $storeProductModel = $this->storeProductFactory->create();
            $this->resource->load($storeProductModel, $storeProduct->getStoreproductId());
            $this->resource->delete($storeProductModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the StoreProduct: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($storeProductId)
    {
        return $this->delete($this->getById($storeProductId));
    }
}