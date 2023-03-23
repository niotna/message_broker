<?php

namespace App\Service;

use App\Message\OrderMessage;
use App\Message\OrderProcessedMessage;

class MessageManager
{

    public function orderMessageBuilder(string $commandeNumber, OrderMessage $message)
    {
        $return = "";
        $createdAt = $message->getCreatedAt();
        if ($createdAt instanceof \DateTime) {
            $return = '[' . $createdAt->format('Y-m-d H:i:s') . ']: ';
        }
        $ownerName = $message->getOwnerName();
        $productName = $message->getProductName();
        if ($ownerName !== '' && $productName !== '') {
            $return = $return . 'Order by ' . $ownerName . ' for product ' . $productName;
        }

        return $return . ' with commande number ' . $commandeNumber;
    }

    public function orderProcessedMessageBuilder(OrderProcessedMessage $message)
    {
        return $message->isStatus() ? ('Order '.$message->getOrderId().' processed'.PHP_EOL) : ('Order '.$message->getOrderId().' not processed'.PHP_EOL);
    }

}