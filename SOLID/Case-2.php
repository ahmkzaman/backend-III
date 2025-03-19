<?php
interface PayrollSystem
{
    public function calculatePayroll(): float;
}

abstract class Employee implements PayrollSystem
{
    protected $hoursWorked;

    public function __construct(float $hoursWorked = 0)
    {
        $this->hoursWorked = $hoursWorked;
    }
    abstract public function calculatePayroll(): float;
}

class GeneralEmployee extends Employee
{
    private $hourlyRate = 500;
    public function calculatePayroll(): float
    {
        return $this->hoursWorked * $this->hourlyRate;
    }
}

class ContractEmployee extends Employee
{
    private $fixedRate = 40000;
    public function calculatePayroll(): float
    {
        return $this->fixedRate;
    }
}

class PartTimeEmployee extends Employee
{
    private $PHourlyRate = 2000;
    public function calculatePayroll(): float
    {
        return $this->hoursWorked * $this->PHourlyRate;
    }
}

class PayrollProcessor
{
    public function process(array $employees): float
    {
        $totoalPayroll = 0;
        foreach ($employees as $employee) {
            $totoalPayroll += $employee->calculatePayroll();
        }
        return $totoalPayroll;
    }
}

$generalEmployee = new GeneralEmployee(10);
$contractEmployee = new ContractEmployee();
$partTimeEmployee = new PartTimeEmployee(5);
$payrollProcessor = new PayrollProcessor();

$employees = [$generalEmployee, $contractEmployee, $partTimeEmployee];
echo $payrollProcessor->process($employees);
