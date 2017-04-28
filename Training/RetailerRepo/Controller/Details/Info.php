<?php
namespace Training\RetailerRepo\Controller\Details;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\RetailerRepo\Api\RetailerRepositoryInterface;

class Info extends Action
{
    private $retailerRepository;

    private $jsonFactory;

    private $filterBuilder;

    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        RetailerRepositoryInterface $retailerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        JsonFactory $jsonFactory
    ) {
        $this->retailerRepository = $retailerRepository;
        $this->jsonFactory = $jsonFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = [];

        /** @var \Training\RetailerRepo\Api\Data\RetailerInterface $retailer */
        $retailer = $this->retailerRepository->getById($this->getRequest()->getParam('id', 1));
        $result['getByID'] = [
            'name'  =>  $retailer->getName(),
            'country'   => $retailer->getCountryId(),
            'region'    =>  $retailer->getRegionId(),
            'city'    =>  $retailer->getCity()
            ];

        /** @var \Magento\Framework\Api\SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('name', 'Jay')->create();

        $retailers = $this->retailerRepository->getList($searchCriteria);
        foreach ($retailers->getItems() as $retailer)
        {
            $result['getList'][] = [
                'name'  =>  $retailer->getName(),
                'country'   => $retailer->getCountryId(),
                'region'    =>  $retailer->getRegionId(),
                'city'    =>  $retailer->getCity()
            ];
        }

        return $this->jsonFactory->create()->setData($result);
    }
}