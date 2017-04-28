<?php
namespace Training\WelcomeMessage\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Training\WelcomeMessage\Model\Message;

class Index extends Action
{
    private $message;

    public function __construct(
        Context $context,
        Message $message
    ) {
        $this->message = $message;
        parent::__construct($context);
    }

    public function execute()
    {
        var_dump($this->message->getWelcomeMessage());
    }
}