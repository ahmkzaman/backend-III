<?php
interface Payment
{
    public function pay();
}
abstract class PaymentMethod
{
    abstract public function pay();
}

class BankTransfer extends PaymentMethod
{
    public $bankAccount;
    public $balance;
    public function __construct($bankAccount, $balance)
    {
        $this->bankAccount = $bankAccount;
        $this->balance = $balance;
    }
    public function pay()
    {
        echo "Paying with Bank Transfer";
    }
}

class Store
{
    public function makePayment() {}
}
