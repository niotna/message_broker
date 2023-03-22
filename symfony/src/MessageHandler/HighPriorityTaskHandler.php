<?php

namespace App\MessageHandler;

use App\Message\HighPriorityTaskMessage;

class HighPriorityTaskHandler
{
    /**
     * @param HighPriorityTaskMessage $message
     */
    public function __invoke(HighPriorityTaskMessage $message)
    {
        $createdAt = $message->getCreatedAt();
        $message = $message->getTask();
        if ($createdAt instanceof \DateTime){
            $message = '[' . $createdAt->format('Y-m-d H:i:s') . ']: ' . $message;
        }
        print_r($message);
    }
}
