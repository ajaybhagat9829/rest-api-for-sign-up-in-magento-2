<?php

namespace Ambient\Customapi\Controller\Index;

class Customapifrontend extends \Magento\Framework\App\Action\Action
{
     protected $customer;
    protected $resultPageFactory;
     
      public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
         \Ambient\Customapi\Model\SignupManagement $customer
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->customer = $customer;
        parent::__construct($context);
    }
     
    public function execute()
    {

        
         $this->customer->postSignup();
        
//        $this->_view->loadLayout();
//        $this->_view->getLayout()->initMessages();
//        $this->_view->renderLayout();
    }
}