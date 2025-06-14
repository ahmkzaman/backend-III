<?php

namespace SpacecraftSystem\Spacecraft;

class Rover implements SpacecraftInterface
{
    private array $state;

    public function __construct(array $state = [])
    {
        $this->state = $state;
    }
    public function receiveCommand(string $command): void
    {
        $this->state['lastCommand'] = $command;
    }
    public function getState(): array
    {
        return $this->state;
    }
}
