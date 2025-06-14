<?php

namespace SpacecraftSystem\Commands;

use SpacecraftSystem\Spacecraft\SpacecraftInterface;

class MoveForwardCommand implements CommandInterface
{
    private float $distance;

    public function __construct(float $distance)
    {
        $this->distance = $distance;
    }
    public function execute(SpacecraftInterface $spacecraft): void
    {
        $spacecraft->receiveCommand("Move forward {$this->distance} meters.");
    }
    public function validate(SpacecraftInterface $spacecraft): bool
    {
        $state = $spacecraft->getState();
        return is_numeric($this->distance) && $this->distance > 0 && $state['batteryLevel'] > 10;
    }
    public function simulate(SpacecraftInterface $spacecraft): string
    {
        return "Simulating moving forward {$this->distance} meters.";
    }
    public function getDescription(): string
    {
        return "Move forward command with distance {$this->distance} meters.";
    }
}
