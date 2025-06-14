<?php

namespace SpacecraftSystem\Spacecraft;

interface SpacecraftInterface
{
    public function receiveCommand(string $command): void;
    public function getState(): array;
}
