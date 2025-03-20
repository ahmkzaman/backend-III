<?php
require 'vendor/autoload.php';

use Ecommerce\Domain\Order;
use Ecommerce\Repositories\SqlOrderRepository;
use Ecommerce\Services\OrderProcessor;

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', 'password');
$sqlRepo = new SqlOrderRepository($pdo);
$processor = new OrderProcessor($sqlRepo);
$order = new Order("123", 99.3, ["item1", "item2"]);
$processor->processOrder($order);
