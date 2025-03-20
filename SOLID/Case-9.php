<?php
interface Discountable
{
    public function getDiscountPrice();
    public function discountType(): string;
}
abstract class Discount implements Discountable
{
    protected $price;
    protected $discountRate;
    protected $discountPrice;
    public function __construct($price, $discountRate)
    {
        $this->price = $price;
        $this->discountRate = $discountRate;
    }
    public function getDiscountPrice()
    {
        $this->discountPrice = $this->price - ($this->price * $this->discountRate / 100);
        return $this->discountPrice;
    }
    abstract public function discountType(): string;
}
class SeasonalDiscount extends Discount
{
    public function discountType(): string
    {
        return "Seasonal Discount";
    }
}
class LoyaltyDiscount extends Discount
{

    public function discountType(): string
    {
        return "Loyalty Discount";
    }
}
class BulkPurchageDiscount extends Discount
{

    public function discountType(): string
    {
        return "Bulk Purchage Discount";
    }
}

class DiscountCalculation
{
    public function calculateDiscount(Discountable $discount)
    {
        echo "Your price is: " . $discount->getDiscountPrice() . " " . "for" . $discount->discountType() . "\n";
    }
}

$sessionalDiscount = new SeasonalDiscount(100, 30);
$loyaltyDiscount = new LoyaltyDiscount(200, 20);
$bulkPurchageDiscount = new BulkPurchageDiscount(300, 10);
$discountCalculation = new DiscountCalculation();
$discountCalculation->calculateDiscount($sessionalDiscount);
$discountCalculation->calculateDiscount($loyaltyDiscount);
$discountCalculation->calculateDiscount($bulkPurchageDiscount);
