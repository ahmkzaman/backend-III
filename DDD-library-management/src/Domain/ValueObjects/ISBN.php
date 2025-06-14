<?php

namespace App\Domain\ValueObjects;

class ISBN
{
    private string $value;

    public function __construct(string $isbn)
    {
        if (!$this->isValid($isbn)) {
            throw new \InvalidArgumentException("Invalid ISBN format.");
        }
        $this->value = $this->normalize($isbn);
    }

    public function isValid(string $isbn): bool
    {
        $isbn = preg_replace('/[^0-9X]/', '', $isbn); // Remove non-numeric characters except 'X'
        return strlen($isbn) === 10 || strlen($isbn) === 13;
    }
    private function normalize(string $isbn): string
    {
        return preg_replace('/[^0-9X]/', '', $isbn); // Normalize by removing non-numeric characters except 'X'   
    }
    public function getValue(): string
    {
        return $this->value;
    }
    public function equals(ISBN $other): bool
    {
        return $this->value === $other->getValue();
    }
}
