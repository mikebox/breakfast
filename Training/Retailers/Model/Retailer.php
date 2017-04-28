<?php

namespace Training\Retailers\Model;

use Magento\Framework\Model\AbstractModel;

class Retailer extends AbstractModel
{
    private $region;

    private $country;

    protected function _construct()
    {
        $this->_init('Training\Retailers\Model\ResourceModel\Retailer');
    }

    public function getRegion()
    {
        if (!$this->region) {
            $this->region = $this->_getResource()->getRegion($this->getRegionId());
        }

        return $this->region;
    }

    public function getCountry()
    {
        if (!$this->country) {
            $this->country = $this->_getResource()->getCountry($this->getCountryId());
        }

        return $this->country;
    }

    public function getAssociatedProductIds()
    {
        return $this->_getResource()->getAssociatedProductIds($this->getId());
    }
}