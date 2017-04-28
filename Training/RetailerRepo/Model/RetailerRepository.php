<?php
namespace Training\RetailerRepo\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Training\RetailerRepo\Api\Data\RetailerSearchResultsInterfaceFactory;
use Training\RetailerRepo\Api\RetailerRepositoryInterface;
use Training\RetailerRepo\Api\Data\RetailerInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Training\RetailerRepo\Model\Data\RetailerDTOFactory;
use Training\Retailers\Model\RetailerFactory;
use Training\Retailers\Model\ResourceModel\Retailer as RetailerResource;

class RetailerRepository implements RetailerRepositoryInterface
{
    private $retailerFactory;

    private $retailerDTOFactory;

    private $searchResultsFactory;

    private $retailerResource;

    private $dataObjectProcessor;

    private $dataObjectHelper;

    public function __construct(
        RetailerFactory $retailerFactory,
        RetailerDTOFactory $retailerDTOFactory,
        DataObjectProcessor $dataObjectProcessor,
        DataObjectHelper $dataObjectHelper,
        RetailerSearchResultsInterfaceFactory $searchResultsFactory,
        RetailerResource $retailerResource
    ) {
        $this->retailerFactory = $retailerFactory;
        $this->retailerDTOFactory = $retailerDTOFactory;
        $this->retailerResource = $retailerResource;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->searchResultsFactory = $searchResultsFactory;
    }


    /**
     * @param int $id
     * @return RetailerInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $retailerModel = $this->retailerFactory->create();
        $this->retailerResource->load($retailerModel, $id);

        if (!$retailerModel->getId())
        {
            throw new NoSuchEntityException(__('Retailer ID not exists'));
        }

        /** @var \Training\RetailerRepo\Api\Data\RetailerInterface $retailerDTO */
        $retailerDTO = $this->retailerDTOFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $retailerDTO,
            $retailerModel->getData(),
            'Training\RetailerRepo\Api\Data\RetailerInterface'
        );

        return $retailerDTO;
    }

    /**
     * @param \Training\RetailerRepo\Api\Data\RetailerInterface $retailer
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function save(RetailerInterface $retailer)
    {
        $retailerModel = $this->retailerFactory->create();

        $retailerData = [
            'id' => $retailer->getId(),
            'name'  =>  $retailer->getName(),
            'country_id'    => $retailer->getCountryId(),
            'region_id'     => $retailer->getRegionId(),
            'city'  => $retailer->getCity(),
            'created_at'    => $retailer->getCreatedAt()
        ];

        if ($retailer->getId())
        {
            $this->retailerResource->load($retailerModel, $retailer->getId());
            $retailerData['id'] = $retailerModel->getId();
        }

        $retailerModel->setData($retailerData);

        $this->retailerResource->save($retailerModel);
        $retailer->setId($retailerModel->getId());

        return $retailer;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\RetailerRepo\Api\Data\RetailerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Training\RetailerRepo\Api\Data\RetailerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection */
        $collection = $this->retailerFactory->create()->getCollection();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup)
        {
            /** @var \Magento\Framework\Api\Filter $filter */
            foreach ($filterGroup->getFilters() as $filter)
            {
                if($filter->getField())
                {
                    $conditionType = $filter->getConditionType() ? : 'eq';
                    $collection->addFieldToFilter($filter->getField(), [$conditionType => $filter->getValue()]);
                }
            }
        }

        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders)
        {
            /** @var \Magento\Framework\Api\SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder)
            {
                if ($sortOrder->getField())
                {
                    $collection->addOrder($sortOrder->getField(), ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? : 'DESC');
                }
            }
        }

        $searchResults->setTotalCount($collection->getSize());

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        /** @var array $retailers */
        $retailers = [];

        foreach ($collection as $retailerModel)
        {
            $retailerDTO = $this->retailerDTOFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $retailerDTO,
                $retailerModel->getData(),
                'Training\RetailerRepo\Api\Data\RetailerInterface'
            );

            $retailers[] = $retailerDTO;
        }

        $searchResults->setItems($retailers);

        return $searchResults;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $retailer = $this->retailerFactory->create()->load($id);
        if (!$retailer->getId())
        {
            $bool = false;
        } else {
            $retailer->delete();
            $bool = true;
        }

        return $bool;
    }
}