<?php

namespace Tychons\Storeorder\Block\Product;

class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;

    protected $_registry;

    protected $_storeproductfactory;

    protected $_storeManager;

    protected $_currency;

    protected $customerSession;

    /**
     * ListProduct constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Directory\Model\Currency $currency,
        \Tychons\Storeorder\Model\StoreProductFactory $storeFactory
    ) {
        $this->_registry = $registry;
        $this->_storeproductfactory = $storeFactory;
        $this->_storeManager = $storeManager;
        $this->customerSession = $customerSession;
        $this->_currency = $currency;
        parent::__construct($context);
    }

    /**
     * Get post parameters
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

    public function getPostUrl()
    {
        return $this->getUrl('storeorder/index/postproduct', ['_secure' => true]);
    }

    //get list of current customer product collection

    public function getCollection()
    {
        $collection = $this->_storeproductfactory->create();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $customer = $objectManager->create("Magento\Customer\Model\Session");

        $customer_id = $customer->getCustomerId();

        return $collection->getCollection()->addFieldToFilter('customer_id', $customer_id);
    }

     /**
     * Get currency symbol for current locale and currency code
     *
     * @return string
     */    
    public function getCurrentCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }

    /**
     * Get store order page url
     *
     * @return string
     */    
    public function getStoreOrderUrl()
    {
        return $this->getUrl('storeorder/index/index', ['_secure' => true]);
    }

}

