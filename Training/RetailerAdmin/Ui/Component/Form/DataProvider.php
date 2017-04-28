<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 2:38 PM
 */
namespace Training\RetailerAdmin\Ui\Component\Form;

use Magento\Framework\Registry;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\Retailers\Model\RetailerFactory;

class DataProvider extends AbstractDataProvider
{
    private $loadedData;

    private $registry;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RetailerFactory $retailerFactory,
        Registry $registry,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->registry = $registry;
        $this->collection = $retailerFactory->create()->getCollection();
        $this->meta = $this->prepareMeta($this->meta);
    }

    public function prepareMeta(array $meta) {
        return $meta;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $this->loadedData = [];

        if ($retailer = $this->registry->registry('retailer')) {
            $this->loadedData[$retailer->getId()] = [
                'id' =>  $retailer->getId(),
                'name'        => $retailer->getName(),
                'country_id'  => $retailer->getCountryId(),
                'region_id'   => $retailer->getRegionId(),
                'city'        => $retailer->getCity()
            ];
        }

        return $this->loadedData;
    }
}