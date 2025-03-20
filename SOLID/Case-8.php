<?php

interface payment
{
    public function paymentMethod(): string;
    public function verify(): bool;
}

class creditCard implements payment
{
    protected $CVV;
    protected $expiryDate;

    public function __construct($CVV, $expiryDate)
    {
        $this->CVV = $CVV;
        $this->expiryDate = $expiryDate;
    }
    public function verify(): bool
    {
        if ($this->CVV == 123 && $this->expiryDate == 2026) {
            return true;
        } else {
            return false;
        }
    }
    public function paymentMethod(): string
    {
        return "Credit Card";
    }
}
class bankTransfer implements payment
{
    protected $accountNumber;
    public function __construct($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }
    public function verify(): bool
    {
        if ($this->accountNumber == 123456789) {
            return true;
        } else {
            return false;
        }
    }
    public function paymentMethod(): string
    {
        return "bank transfer";
    }
}
class digitalWallet implements payment
{
    protected $walletNumber;
    public function __construct($walletNumber)
    {
        $this->walletNumber = $walletNumber;
    }
    public function verify(): bool
    {
        if ($this->walletNumber == 66778899) {
            return true;
        } else {
            return false;
        }
    }
    public function paymentMethod(): string
    {
        return "Digital Wallet";
    }
}

class paymentProcessor
{
    public function processPayment(payment $payment)
    {
        if ($payment->verify()) {
            echo "Payment Successful with " . $payment->paymentMethod() . "\n";
        } else {
            echo "Payment Failed with " . $payment->paymentMethod() . "try with another payment method" . "\n";
        }
    }
}

$creditCard = new creditCard(123, 2026);
$bankTransfer = new bankTransfer(123456);
$digitalWallet = new digitalWallet(66778899);
$paymentProcessor = new paymentProcessor();
$paymentProcessor->processPayment($creditCard);
$paymentProcessor->processPayment($bankTransfer);
$paymentProcessor->processPayment($digitalWallet);
