<?php

namespace Ecommerce\Repositories;

use Ecommerce\Domain\Order;

class NoSqlOrderRepository implements OrderRepository
{
    private $mongoCollection;

    public function __construct($mongoCollection)
    {
        $this->mongoCollection = $mongoCollection;
    }

    public function save(Order $order): void
    {
        $this->mongoCollection->insertOne([
            'orderId' => $order->getOrderId(),
            'total' => $order->getTotal(),
            'items' => $order->getItems()
        ]);
    }

    public function findById(string $orderId): ?Order
    {
        $data = $this->mongoCollection->findOne(['orderId' => $orderId]);
        return $data ? new Order($data['orderId'], (float)$data['total'], $data['items']) : null;
    }
}
