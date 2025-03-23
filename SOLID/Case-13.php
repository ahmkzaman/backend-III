<?php
interface PaymentGatewayInterface
{
    public function processPayment(float $amount): bool;
    public function getGatewayName(): string;
}

class Paypal implements PaymentGatewayInterface
{
    private string $gatewayName;
    public function __construct()
    {
        $this->gatewayName = 'Paypal';
    }

    public function processPayment(float $amount): bool
    {
        echo "Proceessing $amount via" . $this->gatewayName;
        return true;
    }
    public function getGatewayName(): string
    {
        return $this->gatewayName;
    }
}
class PaymentProcessor
{
    private PaymentGatewayInterface $gateway;

    // Inject the gateway dependency (Dependency Inversion)
    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }
    public function makePayment(float $amount)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Amount must be positive");
        } else {
            return $this->gateway->processPayment($amount);
        }
    }
}

try {
    $paypal = new Paypal();
    $processor = new PaymentProcessor($paypal);
    $processor->makePayment(100.00);
} catch (Exception $e) {
    echo "Error" . $e->getMessage();
}
