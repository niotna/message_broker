<?php

namespace App\Message;

class TaskMessage
{
    private $task;
    private ?\DateTime $createdAt;

    public function __construct(string $task)
    {
        $this->task = $task;
        $this->createdAt = null;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
