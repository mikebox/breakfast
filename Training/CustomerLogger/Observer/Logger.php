<?php
namespace Training\CustomerLogger\Observer;

use Magento\Framework\Event\ObserverInterface;

class Logger implements ObserverInterface
{
    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerData = $observer->getCustomer();
        $this->logger->debug("checking");
        $this->logger->debug($customerData->getId());
    }
}