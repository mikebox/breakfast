<?php
namespace Training\RetailerRepo\Controller\Details;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\RetailerRepo\Api\Data\RetailerInterfaceFactory;
use Training\RetailerRepo\Api\RetailerRepositoryInterface;

class Save extends Action
{
    private $retailerRepository;

    private $jsonFactory;

    private $retailerDTOFactory;

    public function __construct(
        Context $context,
        RetailerRepositoryInterface $retailerRepository,
        RetailerInterfaceFactory $retailerInterfaceFactory,
        JsonFactory $jsonFactory
    ) {
        $this->retailerRepository = $retailerRepository;
        $this->retailerDTOFactory = $retailerInterfaceFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = [];

        /** @var \Training\RetailerRepo\Api\Data\RetailerInterface $retailerDTO */
        $retailerDTO = $this->retailerDTOFactory->create();

        $retailerDTO->setName('Another Retailer')
            ->setCountryId('US')
            ->setRegionId(17)
            ->setCity('Vegas');

        /** @var \Training\RetailerRepo\Api\Data\RetailerInterface $retailer */
        $retailer = $this->retailerRepository->save($retailerDTO);

        $result = [
            'name'  =>  $retailer->getName(),
            'id'    => $retailer->getId()
        ];

        return $this->jsonFactory->create()->setData($result);
    }
}