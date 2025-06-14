<?php

namespace App\Domain\ValueObjects;

class Money
{
    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Amount cannot be negative.");
        }

        $this->amount = $amount;
        $this->currency = strtoupper($currency); // Normalize currency to uppercase
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function add(Money $other): Money
    {
        if ($this->currency !== $other->getCurrency()) {
            throw new \InvalidArgumentException("Cannot add money with different currencies.");
        }

        return new Money($this->amount + $other->getAmount(), $this->currency);
    }
}
