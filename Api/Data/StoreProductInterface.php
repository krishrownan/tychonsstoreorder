<?php

namespace Tychons\Storeorder\Api\Data;

interface StoreProductInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const PRODUCT_NAME = 'product_name';
    const STOREPRODUCT_ID = 'storeproduct_id';
    const PRODUCT_PRICE = 'product_price';
    const PRODUCT_ID = 'product_id';
    const PRODUCT_URL = 'product_url';
    const PRODUCT_IMAGE = 'product_image';
    const SKU = 'sku';
    const TOTAL_PRICE = 'total_price';
    const OWNER = 'owner';
    const DESC = 'desc';
    const QTY = 'qty';

    /**
     * Get storeproduct_id
     * @return string|null
     */
    public function getStoreproductId();

    /**
     * Set storeproduct_id
     * @param string $storeproductId
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setStoreproductId($storeproductId);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductId($productId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface $extensionAttributes
    );

    /**
     * Get product_name
     * @return string|null
     */
    public function getProductName();

    /**
     * Set product_name
     * @param string $productName
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductName($productName);

    /**
     * Get product_price
     * @return string|null
     */
    public function getProductPrice();

    /**
     * Set product_price
     * @param string $productPrice
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductPrice($productPrice);

    /**
     * Get product_url
     * @return string|null
     */
    public function getProductUrl();

    /**
     * Set product_url
     * @param string $productUrl
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductUrl($productUrl);

    /**
     * Get qty
     * @return string|null
     */
    public function getQty();

    /**
     * Set qty
     * @param string $qty
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setQty($qty);

    /**
     * Get total_price
     * @return string|null
     */
    public function getTotalPrice();

    /**
     * Set total_price
     * @param string $totalPrice
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setTotalPrice($totalPrice);

    /**
     * Get product_image
     * @return string|null
     */
    public function getProductImage();

    /**
     * Set product_image
     * @param string $productImage
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductImage($productImage);

    /**
     * Get owner
     * @return string|null
     */
    public function getOwner();

    /**
     * Set owner
     * @param string $owner
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setOwner($owner);

    /**
     * Get sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setSku($sku);

    /**
     * Get desc
     * @return string|null
     */
    public function getDesc();

    /**
     * Set desc
     * @param string $desc
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setDesc($desc);
}