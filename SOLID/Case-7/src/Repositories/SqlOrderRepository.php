<?php

namespace Ecommerce\Repositories;

use Ecommerce\Domain\Order;

class SqlOrderRepository implements OrderRepository
{
    private $dbConnection;
    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function save(Order $order): void
    {
        $query = "INSERT INTO orders (order_id, total, items) VALUES (:id, :total, :items)";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([
            ':id' => $order->getOrderId(),
            ':total' => $order->getTotal(),
            ':items' => json_encode($order->getItems())
        ]);
    }

    public function findById(string $orderId): ?Order
    {
        $query = "SELECT * FROM orders WHERE order_id = :id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute([':id' => $orderId]);
        $data = $stmt->fetch();
        return $data ? new Order($data['order_id'], (float)$data['total'], json_decode($data['items'], true)) : null;
    }
}
