<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 27/3/17
 * Time: 10:51 AM
 */

namespace Training\GeoIp\Api;


interface IpToLocatorInterface
{
    /**
     * @param string $ipAddress
     * @return \Training\GeoIp\Api\Data\LocationInterface
     */
    public function convert($ipAddress);
}