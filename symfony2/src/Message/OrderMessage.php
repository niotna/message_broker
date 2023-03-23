<?php

namespace App\Message;

class OrderMessage
{
    private ?\DateTime $createdAt;
    private string $commandeId;
    private string $ownerName;
    private string $productName;

    public function __construct(string $ownerName, string $productName)
    {
        $this->createdAt = null;
        $this->commandeId = '';
        $this->ownerName = $ownerName;
        $this->productName = $productName;
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

    /**
     * @return string
     */
    public function getCommandeId(): string
    {
        return $this->commandeId;
    }

    /**
     * @param string $commandeId
     */
    public function setCommandeId(string $commandeId): void
    {
        $this->commandeId = $commandeId;
    }

    /**
     * @return string
     */
    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    /**
     * @param string $ownerName
     */
    public function setOwnerName(string $ownerName): void
    {
        $this->ownerName = $ownerName;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }
}
