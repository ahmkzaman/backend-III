<?php

namespace Ecommerce\Domain;

class Order
{
    private string $orderId;
    private float $total;
    private array $items;

    public function __construct(string $orderId, float $total, array $items)
    {
        $this->orderId = $orderId;
        $this->total = $total;
        $this->items = $items;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
    public function getTotal(): float
    {
        return $this->total;
    }
    public function getItems(): array
    {
        return $this->items;
    }
}
