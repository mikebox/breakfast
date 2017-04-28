<?php
namespace Training\RetailerRepo\Controller\Details;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\RetailerRepo\Api\Data\RetailerInterfaceFactory;
use Training\RetailerRepo\Api\RetailerRepositoryInterface;

class Delete extends Action
{
    private $retailerRepository;

    public function __construct(
        Context $context,
        RetailerRepositoryInterface $retailerRepository
    ) {
        $this->retailerRepository = $retailerRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $isDeleted = $this->retailerRepository->delete($this->getRequest()->getParam('id'));
        var_dump($isDeleted);
    }
}