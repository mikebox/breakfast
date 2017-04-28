<?php
namespace Training\Retailers\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\Retailers\Model\RetailerFactory;
use Training\Retailers\Model\ResourceModel\Retailer as RetailerResource;

class Simple extends Action
{
    private $retailerFactory;

    private $jsonFactory;

    private $retailerResource;

    /**
     * Simple constructor.
     * @param Context $context
     * @param RetailerFactory $retailerFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        RetailerFactory $retailerFactory,
        JsonFactory $jsonFactory,
        RetailerResource $retailerResource
    ) {
        $this->retailerFactory = $retailerFactory;
        $this->jsonFactory = $jsonFactory;
        $this->retailerResource = $retailerResource;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = [];
        /** @var \Training\Retailers\Model\Retailer $retailerModel */
        $retailerModel = $this->retailerFactory->create();

        $this->retailerResource->load($retailerModel, $this->getRequest()->getParam('id', 1));
        $result['simple'] = [
            'name'  =>  $retailerModel->getName(),
            'country'   =>  $retailerModel->getCountry(),
            'region'    =>  $retailerModel->getRegion(),
            'city'  =>  $retailerModel->getCity(),
            'associatedProducts'  =>  $retailerModel->getAssociatedProductIds()
        ];

        $collection = $this->retailerFactory->create()->getCollection()->addFilterByProduct($this->getRequest()->getParam('p id', 1));
        foreach ($collection as $retailer)
        {
            $result['multiple'][] = [
                'name'  =>  $retailer->getName(),
                'country'   =>  $retailer->getCountry(),
                'region'    =>  $retailer->getRegion(),
                'city'  =>  $retailer->getCity(),
            ];
        }

        return $this->jsonFactory->create()->setData($result);
    }

}