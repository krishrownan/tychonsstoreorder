<?php


namespace Tychons\Storeorder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SchedulerRepositoryInterface
{

    /**
     * Save Scheduler
     * @param \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
    );

    /**
     * Retrieve Scheduler
     * @param string $schedulerId
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($schedulerId);

    /**
     * Retrieve Scheduler matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tychons\Storeorder\Api\Data\SchedulerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Scheduler
     * @param \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tychons\Storeorder\Api\Data\SchedulerInterface $scheduler
    );

    /**
     * Delete Scheduler by ID
     * @param string $schedulerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($schedulerId);
}
