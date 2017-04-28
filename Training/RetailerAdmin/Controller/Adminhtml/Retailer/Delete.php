<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 6:00 PM
 */

namespace Training\RetailerAdmin\Controller\Adminhtml\Retailer;


use Training\RetailerRepo\Api\RetailerRepositoryInterface;
use Magento\Backend\App\Action;

class Delete extends Action
{
    private $retailerRepository;

    public function __construct(
        Action\Context $context,
        RetailerRepositoryInterface $retailerRepository
    ) {
        $this->retailerRepository = $retailerRepository;
        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $this->retailerRepository->delete($id);
                $this->messageManager->addSuccess(__('The Retailer has been deleted.'));
                return $resultRedirect->setPath('*/*/grid');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError('We cant find the retailer to delete.');
        return $resultRedirect->setPath('*/*/grid');
    }
}