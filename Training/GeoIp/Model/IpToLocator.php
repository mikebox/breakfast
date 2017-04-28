<?php
namespace Training\GeoIp\Model;

use Training\GeoIp\Api\IpToLocatorInterface;
use Training\GeoIp\Api\GeoIpInterface;
use Training\GeoIp\Api\Data\LocationInterfaceFactory as LocationFactory;

class IpToLocator implements IpToLocatorInterface
{
    private $geoIp;

    private $locationFactory;

    public function __construct(
        GeoIpInterface $geoIp,
        LocationFactory $locationFactory
    ) {
        $this->geoIp = $geoIp;
        $this->locationFactory = $locationFactory;
    }

    public function convert($ipAddress)
    {
        $locationData = $this->geoIp->lookup($ipAddress);

        return $this->locationFactory->create(
            [
                'country' => $locationData['country'],
                'state' => $locationData['state']
            ]);
    }
}