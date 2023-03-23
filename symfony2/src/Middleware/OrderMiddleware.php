<?php

namespace App\Middleware;

use App\Message\HighPriorityTaskMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use App\Message\OrderMessage;

class OrderMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        // Get the message from the envelope
        $message = $envelope->getMessage();

        // Add a created_at property to the message
        if ($message instanceof OrderMessage) {
            $message->setCreatedAt(new \DateTime());
        }

        // Dispatch the message to the next middleware
        return $stack->next()->handle($envelope, $stack);
    }
}
