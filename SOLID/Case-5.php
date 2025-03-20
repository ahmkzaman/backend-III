<?php
interface OrderProcessor
{
    public function placeOrder(): string;
    public function checkInventory(): bool;
}

interface PaymentProcessor
{
    public function processPayment(): string;
    public function checkPayment(): bool;
}
interface ShipmentProcessor
{
    public function updateShipmentStatus(): string;
    public function checkDelivery(): bool;
}
interface Notifier
{
    public function notifyCustomer(string $message): string;
}
interface InvoiceGenerator
{
    public function generateInvoice(): string;
}

class InventoryService implements OrderProcessor
{
    public function placeOrder(): string
    {
        if ($this->checkInventory()) {
            return "Order placed successfully";
        }
        return "Insufficient inventory";
    }
    public function checkInventory(): bool
    {
        return true;
    }
}

class PaymentService implements PaymentProcessor
{
    public function processPayment(): string
    {
        if ($this->checkPayment()) {
            return "Payment Successful";
        }
        return "Payment Failed";
    }
    public function checkPayment(): bool
    {
        return true;
    }
}
class ShipmentService implements ShipmentProcessor
{
    public function updateShipmentStatus(): string
    {
        if ($this->checkDelivery()) {
            return "Delivered";
        }
        return "status updated";
    }
    public function checkDelivery(): bool
    {
        return false;
    }
}

class Notification implements Notifier
{
    public function notifyCustomer(string $message): string
    {
        return $message;
    }
}

class InvoiceService implements InvoiceGenerator
{
    /**
     * Invoice Generator
     */
    public function generateInvoice(): string
    {
        return "Invoice Generated";
    }
}

class OnlineStore
{
    private OrderProcessor $orderProcessor;
    private PaymentProcessor $paymentProcessor;
    private ShipmentProcessor $shipmentProcessor;
    private Notifier $notifier;
    private InvoiceGenerator $invoiceGenerator;

    public function __construct(
        OrderProcessor $orderProcessor,
        PaymentProcessor $paymentProcessor,
        ShipmentProcessor $shipmentProcessor,
        Notifier $notifier,
        InvoiceGenerator $invoiceGenerator
    ) {
        $this->orderProcessor = $orderProcessor;
        $this->paymentProcessor = $paymentProcessor;
        $this->shipmentProcessor = $shipmentProcessor;
        $this->notifier = $notifier;
        $this->invoiceGenerator = $invoiceGenerator;
    }
    public function processOrder(): string
    {
        $orderResult = $this->orderProcessor->placeOrder();
        if (strpos($orderResult, "failed") !== false) {
            return $orderResult;
        }

        $paymentResult = $this->paymentProcessor->processPayment();
        if (strpos($paymentResult, "failed") !== false) {
            return $paymentResult;
        }
        $this->notifier->notifyCustomer("Order placed and payment successful");
        $shipmentResult = $this->shipmentProcessor->updateShipmentStatus();
        $invoiceResult = $this->invoiceGenerator->generateInvoice();
        return $orderResult . " " . $paymentResult . " " . $shipmentResult . " " . $invoiceResult;
    }
}

$store = new OnlineStore(
    new InventoryService(),
    new PaymentService(),
    new ShipmentService(),
    new Notification(),
    new InvoiceService()
);
echo $store->processOrder() . "\n";
