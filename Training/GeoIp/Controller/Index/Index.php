<?php
namespace Training\GeoIp\Controller\Index;

use Magento\Framework\App\Action\Action;
use Training\GeoIp\Api\VisitorLocationInterface;

class Index extends Action
{
    private $visitorLocation;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        VisitorLocationInterface $visitorLocation
    ) {
        $this->visitorLocation = $visitorLocation;
        parent::__construct($context);
    }

    public function execute()
    {
        $areaCodes = $this->visitorLocation->getAreaCodes();
        var_dump($areaCodes);
        var_dump($areaCodes->getState());
    }
}