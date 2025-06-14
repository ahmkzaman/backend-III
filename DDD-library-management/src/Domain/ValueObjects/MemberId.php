<?php

namespace App\Domain\ValueObjects;

class MemberId
{
    private string $value;

    public function __construct(string $id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException("Member ID cannot be empty.");
        }
        $this->value = $id;
    }
    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(MemberId $other): bool
    {
        return $this->value === $other->getValue();
    }
}
