<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 27/3/17
 * Time: 10:46 AM
 */

namespace Training\GeoIp\Api\Data;

interface LocationInterface
{
    /**
     * @return string|null
     */
    public function getCountry();

    /**
     * @return string|null
     */
    public function getState();
}