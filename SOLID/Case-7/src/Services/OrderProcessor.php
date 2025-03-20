<?php

namespace Ecommerce\Services;

use Ecommerce\Domain\Order;
use Ecommerce\Repositories\OrderRepository;

class OrderProcessor
{
    private OrderRepository $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
    public function processOrder(Order $order): void
    {
        if ($order->getTotal() <= 0) {
            throw new Exception("Order total must be positive");
        }
        $this->repository->save($order);
    }

    public function getOrderById(string $orderId): ?Order
    {
        return $this->repository->findById($orderId);
    }
}
