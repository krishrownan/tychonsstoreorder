<?php


namespace Tychons\Storeorder\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Tychons\Storeorder\Api\Data\SchedulerInterfaceFactory;
use Tychons\Storeorder\Model\ResourceModel\Scheduler\CollectionFactory as SchedulerCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Tychons\Storeorder\Api\SchedulerRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Tychons\Storeorder\Api\Data\SchedulerSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Tychons\Storeorder\Model\ResourceModel\Scheduler as ResourceScheduler;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class SchedulerRepository implements SchedulerRepositoryInterface
{

    protected $dataSchedulerFactory;

    protected $dataObjectHelper;

    private $collectionProcessor;

    protected $schedulerCollectionFactory;

    protected $dataObjectProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    protected $schedulerFactory;


    /**
     * @param ResourceScheduler $resource
     * @param SchedulerFactory $schedulerFactory
     * @param SchedulerInterfaceFactory $dataSchedulerFactory
     * @param SchedulerCollectionFactory $schedulerCollectionFactory
     * @param SchedulerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceScheduler $resource,
        SchedulerFactory $schedulerFactory,
        SchedulerInterfaceFactory $dataSchedulerFactory,
        SchedulerCollectionFactory $schedulerCollectionFactory,
        SchedulerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->schedulerFactory = $schedulerFactory;
        $this->schedulerCollectionFactory = $schedulerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSchedulerFactory = $dataSchedulerFactory;
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
        \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
    ) {
        /* if (empty($scheduler->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $scheduler->setStoreId($storeId);
        } */
        
        $schedulerData = $this->extensibleDataObjectConverter->toNestedArray(
            $scheduler,
            [],
            \Tychons\Storeorder\Api\Data\SchedulerInterface::class
        );
        
        $schedulerModel = $this->schedulerFactory->create()->setData($schedulerData);
        
        try {
            $this->resource->save($schedulerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the scheduler: %1',
                $exception->getMessage()
            ));
        }
        return $schedulerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($schedulerId)
    {
        $scheduler = $this->schedulerFactory->create();
        $this->resource->load($scheduler, $schedulerId);
        if (!$scheduler->getId()) {
            throw new NoSuchEntityException(__('Scheduler with id "%1" does not exist.', $schedulerId));
        }
        return $scheduler->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->schedulerCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Tychons\Storeorder\Api\Data\SchedulerInterface::class
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
        \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
    ) {
        try {
            $schedulerModel = $this->schedulerFactory->create();
            $this->resource->load($schedulerModel, $scheduler->getSchedulerId());
            $this->resource->delete($schedulerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Scheduler: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($schedulerId)
    {
        return $this->delete($this->getById($schedulerId));
    }
}
