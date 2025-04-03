<?php
class Item
{
    //Represents an item stored in the warehouse
}
interface InventoryRepositoryInterface
{
    //Interface for the inventory repository
    public function addStock(string $itemNme, int $quantity);
    public function removeStock(string $itemNme, int $quantity);
    public function getItemStock(string $itemNme): int;
}


//Repository Pattern
class InventoryRepository implements InventoryRepositoryInterface
{
    /**
     * data persistence layer
     * Handles data storage and retrieval for inventory items.
     */
}


class InventoryService
{

    /**
     * Subject (Observable)
     * Manages inventory operations and stock notifications.
     * Handles adding/removing stock and notifying observers.
     */
}


class LowStockObserver
{
    //Inventory Observer.
}


class RestockObserver
{
    //Inventory Observer. 
}


class ReportGenerator
{
    //Generates reports based on inventory data.

}
