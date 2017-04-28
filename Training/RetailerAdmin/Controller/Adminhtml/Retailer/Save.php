<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 6:14 PM
 */

namespace Training\RetailerAdmin\Controller\Adminhtml\Retailer;


use Training\RetailerRepo\Api\Data\RetailerInterfaceFactory;
use Training\RetailerRepo\Api\RetailerRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    const ADMIN_RESOURCE = "Magento_Cms::save";

    private $retailerRepository;

    private $retailer;

    public function __construct(
        Action\Context $context,
        RetailerRepositoryInterface $retailerRepository,
        RetailerInterfaceFactory $retailer
    ) {
        $this->retailerRepository = $retailerRepository;
        $this->retailer = $retailer;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('id');
            /** @var \Training\RetailerRepo\Api\Data\RetailerInterface $dataModel */
            $dataModel = $this->retailer->create();

            if ($id) {
                $dataModel->setId($id);
            }
            $dataModel->setName($data['name'])
                ->setCountryId($data['country_id'])
                ->setRegionId($data['region_id'])
                ->setCity($data['city']);

            try {
                $this->retailerRepository->save($dataModel);
                $this->messageManager->addSuccess('Saved Successfully');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $dataModel->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/grid');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong'));
            }

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/grid');
    }

}