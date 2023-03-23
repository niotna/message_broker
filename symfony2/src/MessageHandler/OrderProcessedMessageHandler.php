<?php

namespace App\MessageHandler;

use App\Message\OrderProcessedMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

class OrderProcessedMessageHandler
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param OrderProcessedMessage $message
     */
    public function __invoke(OrderProcessedMessage $message)
    {
        print_r($message->isStatus() ? ('Order '.$message->getOrderId().' processed'.PHP_EOL) : ('Order '.$message->getOrderId().' not processed'.PHP_EOL));
    }
}
