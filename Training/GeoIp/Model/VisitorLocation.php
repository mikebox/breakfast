<?php
namespace Training\GeoIp\Model;

use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Training\GeoIp\Api\VisitorLocationInterface;
use Training\GeoIp\Api\IpToLocatorInterface;

class VisitorLocation implements VisitorLocationInterface
{
    private $remoteAddress;

    private $debugIpAddress = "8.8.8.8";

    private $ipToLocator;

    /**
     * VisitorLocation constructor.
     * @param RemoteAddress $remoteAddress
     * @param IpToLocatorInterface $ipToLocator
     */
    public function __construct(
        RemoteAddress $remoteAddress,
        IpToLocatorInterface $ipToLocator
    ) {
        $this->remoteAddress = $remoteAddress;
        $this->ipToLocator = $ipToLocator;
    }

    /**
     * @return \Training\GeoIp\Api\Data\LocationInterface
     */
    public function getAreaCodes()
    {
        $ipAddr = $this->getIpAddress();
        return $this->ipToLocator->convert($ipAddr);
    }

    /**
     * @return string
     */
    private function getIpAddress()
    {
        $ipAddress = $this->remoteAddress->getRemoteAddress();
        return ($ipAddress === "127.0.0.1") ? $this->debugIpAddress : $ipAddress;
    }
}