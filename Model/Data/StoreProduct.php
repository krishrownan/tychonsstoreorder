<?php

namespace Tychons\Storeorder\Model\Data;

use Tychons\Storeorder\Api\Data\StoreProductInterface;

class StoreProduct extends \Magento\Framework\Api\AbstractExtensibleObject implements StoreProductInterface
{

    /**
     * Get storeproduct_id
     * @return string|null
     */
    public function getStoreproductId()
    {
        return $this->_get(self::STOREPRODUCT_ID);
    }

    /**
     * Set storeproduct_id
     * @param string $storeproductId
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setStoreproductId($storeproductId)
    {
        return $this->setData(self::STOREPRODUCT_ID, $storeproductId);
    }

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId()
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $productId
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tychons\Storeorder\Api\Data\StoreProductExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product_name
     * @return string|null
     */
    public function getProductName()
    {
        return $this->_get(self::PRODUCT_NAME);
    }

    /**
     * Set product_name
     * @param string $productName
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductName($productName)
    {
        return $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * Get product_price
     * @return string|null
     */
    public function getProductPrice()
    {
        return $this->_get(self::PRODUCT_PRICE);
    }

    /**
     * Set product_price
     * @param string $productPrice
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductPrice($productPrice)
    {
        return $this->setData(self::PRODUCT_PRICE, $productPrice);
    }

    /**
     * Get product_url
     * @return string|null
     */
    public function getProductUrl()
    {
        return $this->_get(self::PRODUCT_URL);
    }

    /**
     * Set product_url
     * @param string $productUrl
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductUrl($productUrl)
    {
        return $this->setData(self::PRODUCT_URL, $productUrl);
    }

    /**
     * Get qty
     * @return string|null
     */
    public function getQty()
    {
        return $this->_get(self::QTY);
    }

    /**
     * Set qty
     * @param string $qty
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * Get total_price
     * @return string|null
     */
    public function getTotalPrice()
    {
        return $this->_get(self::TOTAL_PRICE);
    }

    /**
     * Set total_price
     * @param string $totalPrice
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setTotalPrice($totalPrice)
    {
        return $this->setData(self::TOTAL_PRICE, $totalPrice);
    }

    /**
     * Get product_image
     * @return string|null
     */
    public function getProductImage()
    {
        return $this->_get(self::PRODUCT_IMAGE);
    }

    /**
     * Set product_image
     * @param string $productImage
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setProductImage($productImage)
    {
        return $this->setData(self::PRODUCT_IMAGE, $productImage);
    }

    /**
     * Get owner
     * @return string|null
     */
    public function getOwner()
    {
        return $this->_get(self::OWNER);
    }

    /**
     * Set owner
     * @param string $owner
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setOwner($owner)
    {
        return $this->setData(self::OWNER, $owner);
    }

    /**
     * Get sku
     * @return string|null
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get desc
     * @return string|null
     */
    public function getDesc()
    {
        return $this->_get(self::DESC);
    }

    /**
     * Set desc
     * @param string $desc
     * @return \Tychons\Storeorder\Api\Data\StoreProductInterface
     */
    public function setDesc($desc)
    {
        return $this->setData(self::DESC, $desc);
    }
}