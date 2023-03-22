<?php

namespace App\Message;

class HighPriorityTaskMessage
{
    private $task;
    private $createdAt;

    public function __construct(string $task)
    {
        $this->task = $task;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
