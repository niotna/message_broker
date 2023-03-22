<?php

namespace App\MessageHandler;

use App\Message\TaskMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

class TaskMessageHandler
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param TaskMessage $message
     */
    public function __invoke(TaskMessage $message)
    {
        $createdAt = $message->getCreatedAt();
        $message = $message->getTask();
        if ($createdAt instanceof \DateTime){
            $message = '[' . $createdAt->format('Y-m-d H:i:s') . ']: ' . $message. PHP_EOL;
        }
        print_r($message);
    }
}
