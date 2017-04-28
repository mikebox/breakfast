<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 27/3/17
 * Time: 10:49 AM
 */

namespace Training\GeoIp\Api;


interface GeoIpInterface
{
    /**
     * @param string $ipAddress
     * @return string[]
     */
    public function lookup($ipAddress);
}