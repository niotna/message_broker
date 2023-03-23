<?php

namespace App\MessageHandler;

use App\Message\OrderMessage;
use App\Message\OrderProcessedMessage;
use App\Service\MessageManager;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;
use Symfony\Component\Uid\Uuid;

class OrderMessageHandler
{
    public function __construct(private MessageBusInterface $messageBus, private MessageManager $messageManager)
    {
    }

    /**
     * @param OrderMessage $message
     */
    public function __invoke(OrderMessage $message)
    {
        $commandeNumber = Uuid::v4();
        try {
            $return = $this->messageManager->orderMessageBuilder($commandeNumber, $message);
            print_r($return.PHP_EOL);

            $orderProcessedMessage = new OrderProcessedMessage(true);
        } catch (\Exception $e) {
            $orderProcessedMessage = new OrderProcessedMessage(false);
        }

        $orderProcessedMessage->setOrderId($commandeNumber);
        $this->messageBus->dispatch($orderProcessedMessage);
    }
}
