<?php
interface Product
{
    public function getName(): string;
    public function getPrice(): float;
}
interface Shippable
{
    public function calculateShippingCost(): float;
    public function trackInventory(): int;
    public function deliver(): string;
}
interface Downloadable
{
    public function generateDLink(): string;
    public function issueLicense(): string;
}

interface Schedulable
{
    public function scheduleService(): string;
}

abstract class AbstractProduct implements Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    abstract public function process(): string;
}

class PhysicalProduct extends AbstractProduct implements Shippable
{
    private int $stock;
    public function __construct(string $name, float $price, int $stock)
    {
        parent::__construct($name, $price);
        $this->stock = $stock;
    }
    public function calculateShippingCost(): float
    {
        return 5.9;
    }
    public function trackInventory(): int
    {
        return $this->stock;
    }
    public function deliver(): string
    {
        if ($this->stock > 0) {
            $this->stock--;
            return $this->getName() . "delivered successfully";
        } else {
            return $this->getName() . "Out of stock";
        }
    }
    public function process(): string
    {
        $output = "shipping cost: " . number_format($this->calculateShippingCost(), 2) . "\n";
        $output .= "Inventory: " . $this->trackInventory() . "\n";
        $output .= $this->deliver();
        return $output;
    }
}

class DigitalProduct extends AbstractProduct implements Downloadable
{
    public function __construct(string $name, float $price)
    {
        parent::__construct($name, $price);
    }

    public function generateDLink(): string
    {
        return "https://example.com/download/" . $this->getName();
    }
    public function issueLicense(): string
    {
        return "License 'XYZ-123-ABC' issued for " . $this->getName();
    }
    public function process(): string
    {
        $output = "Download Link: " . $this->generateDLink() . "\n";
        $output .= $this->issueLicense();
        return $output;
    }
}

class ServiceProduct extends AbstractProduct implements Schedulable
{
    public function __construct(string $name, float $price)
    {
        parent::__construct($name, $price);
    }
    public function scheduleService(): string
    {
        return "Service" . $this->getName() . "scheduled for" . date('Y-m-d H:i', strtotime('+1 day'));;
    }
    public function process(): string
    {
        return $this->scheduleService();
    }
}

class ProductManager
{
    public function processProduct(Product $product)
    {
        echo "Processing product: " . $product->getName() . "Price: $" . number_format($product->getPrice(), 2) . "\n";;
        echo $product->process();
        echo "--------------------------\n";
    }
}

$physical = new PhysicalProduct("T-shirt", 19.99, 10);
$digital = new DigitalProduct("E-book", 9.99);
$service = new ServiceProduct("Consulting", 149.99);

$manager = new ProductManager();
$manager->processProduct($physical);
$manager->processProduct($digital);
$manager->processProduct($service);
