<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 21/3/17
 * Time: 7:07 PM
 */
namespace Training\RetailerAdmin\Controller\Adminhtml\Retailer;

use Training\RetailerRepo\Api\RetailerRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    private $resultPageFactory;

    private $retailerRepository;

    private $registry;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        RetailerRepositoryInterface $retailerRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->retailerRepository = $retailerRepository;
        $this->registry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $id = $this->getRequest()->getParam('id');
        $data = null;

        if ($id) {
            $data = $this->retailerRepository->getById($id);

            if (!$data->getId()) {
                $this->messageManager->addError('This retailer no longer exists');
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('*/*/');
            }
        }

        $this->registry->register('retailer', $data);

        $resultPage->getConfig()->getTitle()->prepend(__('Retailers'));
        $resultPage->getConfig()->getTitle()
            ->prepend($data && $data->getId() ? $data->getName() : __('New Retailer'));

        return $resultPage;
    }

}