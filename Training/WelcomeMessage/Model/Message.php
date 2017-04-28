<?php

namespace Training\WelcomeMessage\Model;

use Magento\Framework\Config\DataInterface;
use Training\GeoIp\Api\VisitorLocationInterface;

class Message
{
    private $config;

    private $visitorLocation;

    public function __construct(
        DataInterface $config,
        VisitorLocationInterface $visitorLocation
    ) {
        $this->config = $config;
        $this->visitorLocation = $visitorLocation;
    }

    /**
     * Entry Point
     */
    public function getWelcomeMessage()
    {
        $areaCodes = $this->visitorLocation->getAreaCodes();
        return $this->getMessage($areaCodes->getCountry(), $areaCodes->getState());
    }

    public function getMessage($country, $state)
    {
        if ($this->hasStateMessage($country, $state)) {
            $message = $this->getStateMessage($country, $state);
        } else {
            $message = $this->getDefaultMessage($country);
        }

        return $message;
    }

    public function hasStateMessage($country, $state)
    {
        return $state !== '' && $this->getStateMessage($country, $state) !== '';
    }

    public function getStateMessage($country, $state)
    {
        return (string) $this->config->get($country . "/" . $state);
    }

    public function getDefaultMessage($country)
    {
        return (string) $this->config->get($country . "/default");
    }
}