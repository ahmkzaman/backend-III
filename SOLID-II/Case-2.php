<?php
interface PricingEngineStrategyInterface
{
    public function processPricing($price);
}

class OptionsPricing implements PricingEngineStrategyInterface
{

    public function processPricing($price)
    {
        $totalPrice = 10 * $price;
        return $totalPrice;
    }
}

class SwapPricing implements PricingEngineStrategyInterface
{
    public function processPricing($price)
    {
        if ($price > 100) {
            $totalPrice = 15 * $price;
        } else {
            $totalPrice = 10 * $price;
        }
        return $totalPrice;
    }
}

//future asset class

class FuturePricing implements PricingEngineStrategyInterface
{
    public function processPricing($price)
    {
        if ($price > 100) {
            $totalPrice = 20 * $price;
        } else {
            $totalPrice = 14 * $price;
        }
        return $totalPrice;
    }
}

class PricingProcessor
{
    protected  $price;

    public function __construct(PricingEngineStrategyInterface $price)
    {
        $this->price = $price;
    }

    public function processPricing()
    {
        return $this->price->processPricing($this->price);
    }
}
