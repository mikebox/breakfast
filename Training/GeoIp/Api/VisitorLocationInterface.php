<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 27/3/17
 * Time: 10:53 AM
 */

namespace Training\GeoIp\Api;


interface VisitorLocationInterface
{
    /**
     * @return \Training\GeoIp\Api\Data\LocationInterface
     */
    public function getAreaCodes();
}