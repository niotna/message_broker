<?php

namespace App\Controller;

use App\Message\OrderMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="create_order", methods={"POST"})
     */
    public function createOrder(Request $request, MessageBusInterface $messageBus): Response
    {
        try {
            $content = json_decode($request->getContent(), true);
            $ownerName = $content['ownerName'];
            $productName = $content['productName'];
            $message = new OrderMessage($ownerName, $productName);
            $messageBus->dispatch($message);
        } catch (\Exception $e) {
            return new Response('Error: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response('Order created successfully', Response::HTTP_CREATED);
    }
}
