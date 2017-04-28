<?php

namespace Training\GeoIp\Model;

use Magento\Framework\HTTP\ClientFactory;
use Training\GeoIp\Api\GeoIpInterface;

class GeoIp implements GeoIpInterface
{
    private $endPoint = "http://freegeoip.net/json/";

    private $httpClient;

    public function __construct(
        ClientFactory $clientFactory
    ) {
        $this->httpClient = $clientFactory->create();
    }

    public function lookup($ipAddress)
    {

        $this->httpClient->get($this->getUri($ipAddress));
        $response = json_decode($this->httpClient->getBody(), true);
        return [
            'country'   =>  &$response['country_code'],
            'state' =>  ($response['region_code']) ? : ''
        ];
    }

    public function getUri($ipAddress)
    {
        return $this->endPoint . $ipAddress;
    }

}