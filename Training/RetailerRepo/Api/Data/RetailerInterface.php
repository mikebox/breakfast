<?php

namespace Training\RetailerRepo\Api\Data;

interface RetailerInterface
{
    CONST RETAILER_ID = "id";

    CONST RETAILER_NAME = "name";

    CONST RETAILER_COUNTRY_ID = "country_id";

    CONST RETAILER_REGION_ID = "region_id";

    CONST RETAILER_CITY = "city";

    CONST RETAILER_CREATED_AT = "created_at";

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getCountryId();

    /**
     * @return int
     */
    public function getRegionId();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param int $id
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setId($id);

    /**
     * @param string $name
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setName($name);

    /**
     * @param string $countryId
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCountryId($countryId);

    /**
     * @param int $regionId
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setRegionId($regionId);

    /**
     * @param string $city
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCity($city);

    /**
     * @param string $createdAt
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function setCreatedAt($createdAt);
}