<?php

namespace Tychons\Storeorder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface StoreProductRepositoryInterface
{

    /**
     * Save StoreProduct
     * @param \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
    );

    /**
     * Retrieve StoreProduct
     * @param string $storeproductId
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($storeproductId);

    /**
     * Retrieve StoreProduct matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tychons\Storeorder\Api\Data\StoreProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete StoreProduct
     * @param \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tychons\Storeorder\Api\Data\StoreProductInterface $storeProduct
    );

    /**
     * Delete StoreProduct by ID
     * @param string $storeproductId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($storeproductId);
}