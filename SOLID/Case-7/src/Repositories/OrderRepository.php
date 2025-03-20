<?php

namespace Ecommerce\Repositories;

use Ecommerce\Domain\Order;

interface OrderRepository
{
    public function save(Order $order): void;
    public function findById(string $orderId): ?Order;
}
