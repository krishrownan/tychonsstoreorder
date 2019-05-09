<?php


namespace Tychons\Storeorder\Api\Data;

interface SchedulerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const SCHEDULER_ID = 'scheduler_id';
    const TIME = 'time';
    const DAYS_WEEK = 'days_week';

    /**
     * Get scheduler_id
     * @return string|null
     */
    public function getSchedulerId();

    /**
     * Set scheduler_id
     * @param string $schedulerId
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setSchedulerId($schedulerId);

    /**
     * Get days_week
     * @return string|null
     */
    public function getDaysWeek();

    /**
     * Set days_week
     * @param string $daysWeek
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setDaysWeek($daysWeek);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface $extensionAttributes
    );

    /**
     * Get time
     * @return string|null
     */
    public function getTime();

    /**
     * Set time
     * @param string $time
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setTime($time);
}
