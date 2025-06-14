<?php

namespace SpacecraftSystem\Commands;

use SpacecraftSystem\Spacecraft\SpacecraftInterface;

interface CommandInterface
{
    public function execute(SpacecraftInterface $spacecraft): void;
    public function validate(SpacecraftInterface $spacecraft): bool;
    public function simulate(SpacecraftInterface $spacecraft): string;
    public function getDescription(): string;
}
