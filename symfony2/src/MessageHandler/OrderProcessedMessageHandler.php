<?php

namespace App\MessageHandler;

use App\Message\OrderProcessedMessage;
use App\Service\MessageManager;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

class OrderProcessedMessageHandler
{
    public function __construct(private MessageManager $messageManager)
    {
    }

    /**
     * @param OrderProcessedMessage $message
     */
    public function __invoke(OrderProcessedMessage $message)
    {
        $return = $this->messageManager->orderProcessedMessageBuilder($message);
        print_r($return.PHP_EOL);
    }
}
