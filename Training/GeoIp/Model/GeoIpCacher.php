<?php
namespace Training\GeoIp\Model;

use Magento\Framework\Config\CacheInterface;
use Training\GeoIp\Api\GeoIpInterface;

class GeoIpCacher implements GeoIpInterface
{
    private $cache;

    private $geoIp;

    public function __construct(
        CacheInterface $cache,
        GeoIpInterface $geoIp
    ) {
        $this->cache = $cache;
        $this->geoIp = $geoIp;
    }

    public function lookup($ipAddress)
    {
        $cacheKey = "training_ip_" . $ipAddress;
        $location = $this->cache->load($cacheKey);
        if ($location !== false) {
            $locationData = json_decode($location, true);
        } else {
            $locationData = $this->geoIp->lookup($ipAddress);
            $this->cache->save(json_encode($locationData), $cacheKey, ['geoIp']);
        }

        return $locationData;
    }
}