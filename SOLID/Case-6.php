<?php
abstract class Vehicle
{
    protected $speed;
    protected $speedLimit;
    public function __construct($speed, $speedLimit)
    {
        $this->speed = $speed;
        $this->speedLimit = $speedLimit;
    }
    public function getSpeed()
    {
        return $this->speed;
    }
    public function getSpeedLimit()
    {
        return $this->speedLimit;
    }
    abstract public function vehicleType(): string;
}

class Bike extends Vehicle
{
    public function vehicleType(): string
    {
        return "Bike";
    }
}

class Car extends Vehicle
{
    public function vehicleType(): string
    {
        return "Car";
    }
}

class Airplane extends Vehicle
{
    public function vehicleType(): string
    {
        return "Airplane";
    }
}

class SpeedTrackingSystem
{
    public function trackSpeed(Vehicle $vehicle): void
    {
        if ($vehicle->getSpeed() > $vehicle->getSpeedLimit()) {
            echo "Speed limit exceeded for " . $vehicle->vehicleType() . "\n";
        } else {
            echo "Speed within limit for " . $vehicle->vehicleType() . "\n";
        }
    }
}

$bike = new Bike(50, 50);
$car = new Car(80, 60);
$airplane = new Airplane(500, 400);
$speedTracking = new SpeedTrackingSystem();
$speedTracking->trackSpeed($bike);
$speedTracking->trackSpeed($car);
$speedTracking->trackSpeed($airplane);
