<?php


namespace Tychons\Storeorder\Api\Data;

interface SchedulerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Scheduler list.
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface[]
     */
    public function getItems();

    /**
     * Set days_week list.
     * @param \Tychons\Storeorder\Api\Data\SchedulerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
