<?php

namespace Tychons\Storeorder\Api\Data;

interface StoreProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get StoreProduct list.
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface[]
     */
    public function getItems();

    /**
     * Set product_id list.
     * @param \Tychons\Storeorder\Api\Data\StoreProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}