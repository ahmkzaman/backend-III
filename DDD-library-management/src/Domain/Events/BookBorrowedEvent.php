<?php

namespace App\Domain\Events;

class BookBorrowedEvent extends DomainEvent
{
    private string $bookId;
    private string $memberId;
    private \DateTime $dueDate;
    public function __construct(string $bookId, string $memberId, \DateTime $dueDate)
    {
        parent::__construct();
        $this->bookId = $bookId;
        $this->memberId = $memberId;
        $this->dueDate = $dueDate;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }
}
