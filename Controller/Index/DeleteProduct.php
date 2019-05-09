<?php

namespace Tychons\Storeorder\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;

class DeleteProduct extends \Magento\Framework\App\Action\Action 
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    protected $_storeProductFactory;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $JsonFactory,
        \Tychons\Storeorder\Model\StoreProductFactory $StoreProductFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $JsonFactory;
        $this->_storeProductFactory = $StoreProductFactory;
        return parent::__construct($context);
    }


    public function execute()
    {

        //store post data start

        $product_id = $this->getRequest()->getParam('product_id');

        $customer_id = $this->getRequest()->getParam('customer_id');

        $result = $this->resultJsonFactory->create();

        $resultPage = $this->resultPageFactory->create();

        //$model = $this->_objectManager->create(\Tychons\Storeorder\Model\StoreProduct::class);

        //$getproduct = $model->load(array("product_id"=>2972,"customer_id"=>1));

        $objectManager = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');

        $connection= $objectManager->getConnection();

        $Table = $connection->getTableName('tychons_storeorder_product');

        $selectrow = "DELETE FROM ".$Table." WHERE product_id='".$product_id."' AND customer_id='".$customer_id."'";


        try {

            $connection->query($selectrow);

            $model = $this->_objectManager->create(\Tychons\Storeorder\Model\StoreProduct::class);

            $product_collection = $model->getCollection()
                                        ->addFieldToFilter('customer_id', $customer_id);

            $getdata = $product_collection->getData();

            $getdata['count'] = $product_collection->getSize();

            $getdata['message'] = 'Product has been deleted';

            /*$getdata = $connection->fetchAll("SELECT * FROM ".$Table." WHERE customer_id='".$customer_id."'");

            $getdata['message'] = 'Product has been deleted';

            $getdata['count'] = count($getdata);*/
                
        } catch (LocalizedException $e) {
               
            $getdata = $e->getMessage();

        } catch (\Exception $e) {

            $getdata = 'Something went wrong while saving the Storeproduct.';

        }

        $result->setData($getdata);
        
        return $result;
    } 
}
