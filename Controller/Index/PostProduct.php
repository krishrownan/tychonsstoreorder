<?php

namespace Tychons\Storeorder\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Directory\Model\Currency;

class PostProduct extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    protected $_storeManager;

    protected $_currency; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StoreManagerInterface $storeManager,
        Currency $currency,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_storeManager = $storeManager;
        $this->_currency = $currency; 
        return parent::__construct($context);
    }


    public function execute()
    {

        //store post data start

        $product_id = $this->getRequest()->getParam('product_id');

        $product_name = $this->getRequest()->getParam('product_name');

        $product_price = $this->getRequest()->getParam('product_price');

        $product_url = $this->getRequest()->getParam('product_url');

        $qty = $this->getRequest()->getParam('qty');

        $total_price = $this->getRequest()->getParam('total_price');

        $product_image = $this->getRequest()->getParam('product_image');

        $owner = $this->getRequest()->getParam('owner');

        $sku = $this->getRequest()->getParam('sku');

        $desc = $this->getRequest()->getParam('desc');

        $data = $this->getRequest()->getPostValue();

        $currency_symbol = $this->_currency->getCurrencySymbol();

        //post data ends

        //get current logged in user details start

        $customer = $this->_objectManager->create("Magento\Customer\Model\Session");

        $customer_id = $customer->getCustomerId();

        $group_id = $customer->getCustomer()->getGroupId();

        $role = $this->_objectManager->create("Magento\Customer\Model\Group")->load($group_id); 
        
        $customer_role = $role->getCustomerGroupCode();

        //end logged in user details

        $storeorder = array(

            'product_id' =>$product_id,
            'product_name' =>$product_name,
            'product_price' =>$currency_symbol.$product_price,
            'product_url' =>$product_url,
            'qty' =>$qty,
            'total_price' =>$currency_symbol.$total_price,
            'product_image' =>$product_image,
            'owner' =>$owner,
            'sku' =>$sku,
            'desc' =>$desc,
            'customer_id' =>$customer_id,
            'role' =>$customer_role

        );

        $result = $this->resultJsonFactory->create();

        $resultPage = $this->resultPageFactory->create();

        $model = $this->_objectManager->create(\Tychons\Storeorder\Model\StoreProduct::class);

        //if customer already added product to cart just update the cart

        $product_exists = $model->getCollection()
                                ->addFieldToFilter('product_id', $product_id)
                                ->addFieldToFilter('customer_id', $customer_id);

        $product_count = $product_exists->getSize();

        if ($product_count > 0) 
        { 
            foreach ($product_exists as $key => $product)
            {
                $getQty = $product->getQty();

                $totalQty = $qty+$getQty;
            
                $product->setQty($totalQty)->save();
            
            }

            $model = $this->_objectManager->create(\Tychons\Storeorder\Model\StoreProduct::class);

            $product_collection = $model->getCollection()
                                        ->addFieldToFilter('customer_id', $customer_id);

            $collection_data = $product_collection->getData();

            $collection_data['count'] = $product_collection->getSize();

            $result->setData($collection_data);
        
            return $result;

        }

        //update cart ends

        $model->setData($storeorder);

        try {

            $model->save();

            $model = $this->_objectManager->create(\Tychons\Storeorder\Model\StoreProduct::class);

            $product_collection = $model->getCollection()
                                        ->addFieldToFilter('customer_id', $customer_id);

            $getdata = $product_collection->getData();

            $getdata['count'] = $product_collection->getSize();

            $getdata['message'] = 'Product added to store order';
                
        } catch (LocalizedException $e) {
               
            $getdata = $e->getMessage();

        } catch (\Exception $e) {

            $getdata = 'Something went wrong while saving the Storeproduct.';
        }

        $result->setData($getdata);
        
        return $result;
    } 
}
