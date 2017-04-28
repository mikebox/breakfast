<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 27/3/17
 * Time: 10:55 AM
 */

namespace Training\GeoIp\Model\Data;


use Training\GeoIp\Api\Data\LocationInterface;

class Location implements LocationInterface
{
    private $country;

    private $state;

    /**
     * Location constructor.
     * @param string $country
     * @param string $state
     */
    public function __construct($country, $state)
    {
        $this->country = $country;
        $this->state = $state;
    }

    /**
     * Get Country
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get State
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

}