<?php
/*
 * This code demonstrates the Strategy Pattern for calculating taxes based on different locations.
 * It uses a factory method to create the appropriate tax strategy based on the location.
 * The code adheres to SOLID principles well.
 */
interface TaxStrategyInterface
{
    public function calculate(float $amount): float;
}


class StateTax implements TaxStrategyInterface
{
    public function calculate(float $amount): float
    {
        return $amount * 0.05; // 5% state tax
    }
}

class FederalTax implements TaxStrategyInterface
{
    public function calculate(float $amount): float
    {
        return $amount * 0.10; // 10% federal tax
    }
}

class InternationalTax implements TaxStrategyInterface
{
    public function calculate(float $amount): float
    {
        return $amount * 0.15; // 15% international tax
    }
}

/* The TaxCalculator class uses the Strategy Pattern to calculate tax based on the selected strategy.
 * It is open for extension (new tax strategies can be added) but closed for modification (existing code does not need to change).
 */
class TaxCalculator
{
    private TaxStrategyInterface $taxStrategy;

    public function __construct(string $location)
    {
        $this->taxStrategy = TaxStrategyFactory::create($location);
    }

    public function calculateTax(float $amount): float
    {
        return $this->taxStrategy->calculate($amount);
    }
}

/*
 * The TaxStrategyFactory is responsible for creating the appropriate tax strategy based on the location.
 * This adheres to the Open/Closed Principle, allowing for easy extension of new tax strategies without modifying existing code.
 * It also adheres to the factory method pattern, encapsulating the instantiation logic.
 */
class TaxStrategyFactory
{
    public static function create(string $location): TaxStrategyInterface
    {
        return match ($location) {
            'state' => new StateTax(),
            'federal' => new FederalTax(),
            'international' => new InternationalTax(),
            default => throw new InvalidArgumentException("Invalid location: $location"),
        };
    }
}
$location = 'international';
$amount = 1000.00;

try {
    $taxCalculator = new TaxCalculator($location);
    $tax = $taxCalculator->calculateTax($amount);
    echo "The tax for $location on amount $amount is: $tax";
} catch (InvalidArgumentException $e) {
    echo "Error:" . $e->getMessage();
}
