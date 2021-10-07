<?php

namespace Training\Test\Controller\Product;


class View extends \Magento\Catalog\Controller\Product\View
{
    private $customerSession;
    private $redirectFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Helper\Product\View $viewHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory, 
        \Psr\Log\LoggerInterface $logger = null,
        \Magento\Framework\Json\Helper\Data $jsonHelper = null,            
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory, $logger, $jsonHelper);
    }    
    
    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
        return parent::execute();
    }
}
