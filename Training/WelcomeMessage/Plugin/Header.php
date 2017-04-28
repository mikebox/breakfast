<?php

namespace Training\WelcomeMessage\Plugin;

use Training\WelcomeMessage\Model\Message;

class Header
{
    private $message;

    public function __construct(
        Message $message
    ) {
        $this->message = $message;
    }

    public function afterGetWelcome(\Magento\Theme\Block\Html\Header $header, $result)
    {
        $message = $this->message->getWelcomeMessage();
        return $message !== '' ? $message : $result;
    }
}