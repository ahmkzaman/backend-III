<?php

namespace SpacecraftSystem\Commands;

use SpacecraftSystem\Spacecraft\SpacecraftInterface;

class TakePhotoCommand implements CommandInterface
{
    public function execute(SpacecraftInterface $spacecraft): void
    {
        $spacecraft->receiveCommand("Take photo");
    }
    public function validate(SpacecraftInterface $spacecraft): bool
    {
        $state = $spacecraft->getState();
        return ($state[cameraOperationl] ?? false);
    }
    public function simulate(SpacecraftInterface $spacecraft): string
    {
        return "Simulationg taking photos";
    }
    public function getDescription(): string
    {
        return "Take photo command";
    }
}
