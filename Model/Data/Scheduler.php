<?php


namespace Tychons\Storeorder\Model\Data;

use Tychons\Storeorder\Api\Data\SchedulerInterface;

class Scheduler extends \Magento\Framework\Api\AbstractExtensibleObject implements SchedulerInterface
{

    /**
     * Get scheduler_id
     * @return string|null
     */
    public function getSchedulerId()
    {
        return $this->_get(self::SCHEDULER_ID);
    }

    /**
     * Set scheduler_id
     * @param string $schedulerId
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setSchedulerId($schedulerId)
    {
        return $this->setData(self::SCHEDULER_ID, $schedulerId);
    }

    /**
     * Get days_week
     * @return string|null
     */
    public function getDaysWeek()
    {
        return $this->_get(self::DAYS_WEEK);
    }

    /**
     * Set days_week
     * @param string $daysWeek
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setDaysWeek($daysWeek)
    {
        return $this->setData(self::DAYS_WEEK, $daysWeek);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tychons\Storeorder\Api\Data\SchedulerExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get time
     * @return string|null
     */
    public function getTime()
    {
        return $this->_get(self::TIME);
    }

    /**
     * Set time
     * @param string $time
     * @return \Tychons\Storeorder\Api\Data\SchedulerInterface
     */
    public function setTime($time)
    {
        return $this->setData(self::TIME, $time);
    }
}
