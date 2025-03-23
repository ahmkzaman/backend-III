<?php

interface Printable
{
    public function print(): string;
}

interface Scannable
{
    public function scan(): string;
}

interface Faxable
{
    public function fax(): string;
}

abstract class Printer
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class BasicPrinter extends Printer implements Printable
{
    public function print(): string
    {
        return "print";
    }
}

class MultiFunctionPrinter extends Printer implements Printable, Scannable, Faxable
{
    public function print(): string
    {
        return "print";
    }

    public function scan(): string
    {
        return "scan";
    }
    public function fax(): string
    {
        return "fax";
    }
}

class PrinterProcessor
{
    private function formatOutput(string $printerName, string $action): string
    {
        return "{$printerName} performs {$action}";
    }

    public function processPrint(Printable $printer): string
    {
        $action = $printer->print();
        return $this->formatOutput($printer->getName(), $action);
    }

    public function processScan(Scannable $printer): string
    {
        $action = $printer->scan();
        return $this->formatOutput($printer->getName(), $action);
    }
    public function processFax(Faxable $printer): string
    {
        $action = $printer->fax();
        return $this->formatOutput($printer->getName(), $action);
    }
}


$basicPrinter = new BasicPrinter("Epson");
$multiPrinter = new MultiFunctionPrinter("Canon");
$processor = new PrinterProcessor();

echo $processor->processPrint($basicPrinter) . PHP_EOL;
echo $processor->processPrint($multiPrinter) . PHP_EOL;
echo $processor->processScan($multiPrinter) . PHP_EOL;
echo $processor->processFax($multiPrinter) . PHP_EOL;
