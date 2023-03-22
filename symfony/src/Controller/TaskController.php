<?php

namespace App\Controller;

use App\Message\TaskMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="create_task", methods={"POST"})
     */
    public function createTask(Request $request, MessageBusInterface $messageBus): Response
    {
        try {
            $content = json_decode($request->getContent(), true);
            $task = $content['task'];// Create a TaskMessage object and dispatch it
            $message = new TaskMessage($task);
            $messageBus->dispatch($message);
        } catch (\Exception $e) {
            return new Response('Error: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response('Task created successfully', Response::HTTP_CREATED);
    }
}
