<?php
namespace Training\RetailerRepo\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Training\RetailerRepo\Api\Data\RetailerInterface;

class RetailerDTO extends AbstractExtensibleObject implements RetailerInterface
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_get(self::RETAILER_ID);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_get(self::RETAILER_NAME);
    }

    /**
     * @return string
     */
    public function getCountryId()
    {
        return $this->_get(self::RETAILER_COUNTRY_ID);
    }

    /**
     * @return int
     */
    public function getRegionId()
    {
        return $this->_get(self::RETAILER_REGION_ID);
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_get(self::RETAILER_CITY);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_get(self::RETAILER_CREATED_AT);
    }

    /**
     * @param int $id
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::RETAILER_ID, $id);
    }

    /**
     * @param string $name
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setName($name)
    {
        return $this->setData(self::RETAILER_NAME, $name);
    }

    /**
     * @param string $countryId
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCountryId($countryId)
    {
        return $this->setData(self::RETAILER_COUNTRY_ID, $countryId);
    }

    /**
     * @param int $regionId
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setRegionId($regionId)
    {
        return $this->setData(self::RETAILER_REGION_ID, $regionId);
    }

    /**
     * @param string $city
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCity($city)
    {
        return $this->setData(self::RETAILER_CITY, $city);
    }

    /**
     * @param string $createdAt
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::RETAILER_CREATED_AT, $createdAt);
    }
}