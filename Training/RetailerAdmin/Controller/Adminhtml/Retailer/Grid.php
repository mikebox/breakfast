<?php
namespace Training\RetailerAdmin\Controller\Adminhtml\Retailer;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Grid extends Action
{
    private $pageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Retailers'));

        return $resultPage;
    }

}