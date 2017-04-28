<?php
namespace Training\Retailers\Model\ResourceModel;

use Magento\Directory\Model\CountryFactory;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Retailer extends AbstractDb
{
    CONST ENTITY_TABLE = "training_retailers";

    CONST ENTITY_PRODUCT_TABLE = "training_retailers_product";

    CONST PRIMARY_KEY = "id";

    private $regionFactory;

    private $countryFactory;

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        RegionFactory $regionFactory,
        CountryFactory $countryFactory,
        $connectionName = null
    ) {
        $this->regionFactory = $regionFactory;
        $this->countryFactory = $countryFactory;
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init(self::ENTITY_TABLE, self::PRIMARY_KEY);
    }

    public function getRegion($regionId)
    {
        return $this->regionFactory->create()->load($regionId)->getName();
    }

    public function getCountry($countryId)
    {
        return $this->countryFactory->create()->load($countryId)->getName();
    }

    public function getAssociatedProductIds($retailerId)
    {
        $select = $this->getConnection()->select()
            ->from(['r2p'   =>  self::ENTITY_PRODUCT_TABLE])
            ->where("retailer_id=?", $retailerId);

        $collection = $this->getConnection()->fetchAll($select);
        $ids = [];

        foreach ($collection as $item)
        {
            $ids[] = $item['product_id'];
        }

        return $ids;
    }
}