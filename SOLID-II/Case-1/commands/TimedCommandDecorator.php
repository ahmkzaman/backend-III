<?php

namespace SpacecraftSystem\Commands;

use SpacecraftSystem\Spacecraft\SpacecraftInterface;
use DateTime;

class TimedCommandDecorator implements CommandInterface
{
    private CommandInterface $command;
    private DateTime $executionTime;

    public function __construct(CommandInterface $command, DateTime $executionTime)
    {
        $this->command = $command;
        $this->executionTime = $executionTime;
    }

    public function execute(SpacecraftInterface $spacecraft): void
    {
        $now = new DateTime();
        if ($this->executionTime > $now) {
            throw new \Exception("Command cannot be executed before the scheduled time: " . $this->executionTime->format('Y-m-d H:i:s'));
        }
        $this->command->execute($spacecraft);
    }

    public function validate(SpacecraftInterface $spacecraft): bool
    {
        return $this->command->validate($spacecraft);
    }

    public function simulate(SpacecraftInterface $spacecraft): string
    {
        return $this->command->simulate($spacecraft) . " (scheduled for " . $this->executionTime->format('Y-m-d H:i:s') . ")";
    }

    public function getDescription(): string
    {
        return "Timed({$this->command->getDescription()}, time={$this->executionTime->format('Y-m-d H:i:s')})";
    }
}
//     if ($now >= $this->executionTime) {