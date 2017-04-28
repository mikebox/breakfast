<?php

namespace Training\GeoIp\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Json extends Action
{
    private $jsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = [
            "name"    =>  "Alice",
            "code"  => "CA",
            "region" => "TBN"
        ];
        return $this->jsonFactory->create()->setData($result);
    }

}