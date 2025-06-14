<?php

namespace App\Domain\Events;

use App\Domain\ValueObjects\Money;

class BookReturnedEvent extends DomainEvent
{
    private string $bookId;
    private string $memberId;
    private ?Money $fine;

    public function __construct(string $bookId, string $memberId, ?Money $fine)
    {
        parent::__construct();
        $this->bookId = $bookId;
        $this->memberId = $memberId;
        $this->fine = $fine;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function getFine(): ?Money
    {
        return $this->fine;
    }
}
