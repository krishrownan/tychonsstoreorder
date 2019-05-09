<?php


namespace Tychons\Storeorder\Controller\Schedule;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $scheduler = (array) $this->getRequest()->getPost();

        if(!empty($scheduler)){


            $week_days = $this->getRequest()->getParam('weekday');

            $time = $this->getRequest()->getParam('est_time');

            $model = $this->_objectManager->create(\Tychons\Storeorder\Model\Scheduler::class);

            //remove existing records

            $objectmanager = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection= $objectmanager->getConnection();

            $table = $objectmanager->getTableName('tychons_storeorder_scheduler');
            $sql = "TRUNCATE " . $table;
            $connection->query($sql);

            //end

            $set_schedule = $model->setData(array("days_week"=>serialize($week_days),"time"=>$time));

            $set_schedule->save();

            if($set_schedule){

                $this->messageManager->addSuccessMessage(__('Schedule successfully updated!'));

                $resultRedirect = $this->resultRedirectFactory->create();
 
                return $resultRedirect->setPath('*/*/index');

            }else{

                $this->messageManager->addError(__('Failed to update schedule!'));

                $resultRedirect = $this->resultRedirectFactory->create();
 
                return $resultRedirect->setPath('*/*/index');
            }

        }
        return $this->resultPageFactory->create();
    }
}
