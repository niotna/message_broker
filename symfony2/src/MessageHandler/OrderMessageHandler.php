<?php

namespace App\MessageHandler;

use App\Message\OrderMessage;
use App\Message\OrderProcessedMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;
use Symfony\Component\Uid\Uuid;

class OrderMessageHandler
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param OrderMessage $message
     */
    public function __invoke(OrderMessage $message)
    {
        $commandeNumber = Uuid::v4();
        $return = "";
        try {
            $createdAt = $message->getCreatedAt();
            if ($createdAt instanceof \DateTime) {
                $return = '[' . $createdAt->format('Y-m-d H:i:s') . ']: ';
            }
            $ownerName = $message->getOwnerName();
            $productName = $message->getProductName();
            if ($ownerName !== '' && $productName !== '') {
                $return = $return . 'Order by ' . $ownerName . ' for product ' . $productName;
            }

            $return = $return . ' with commande number ' . $commandeNumber;
            print_r($return.PHP_EOL);

            $orderProcessedMessage = new OrderProcessedMessage(true);
        } catch (\Exception $e) {
            $orderProcessedMessage = new OrderProcessedMessage(false);
        }

        $orderProcessedMessage->setOrderId($commandeNumber);
        $this->messageBus->dispatch($orderProcessedMessage);
    }
}
