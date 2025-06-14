<?php

namespace App\Domain\Events;

abstract class DomainEvent
{
    private \DateTime $occurredOn;

    public function __construct()
    {
        $this->occurredOn = new \DateTime();
    }

    public function getOccurredOn(): \DateTime
    {
        return $this->occurredOn;
    }
}
