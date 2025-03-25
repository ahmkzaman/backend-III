<?php
interface PaymentInterface
{
    public function validate(): bool;
    public function process(BankService $bankService): bool;
    public function getDetails(): array;
}
abstract class CardPayment implements PaymentInterface
{
    protected array $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }
    public function validate(): bool
    {
        return isset($this->details['card_number']) && isset($this->details['expiry']) && isset($this->details['cvv']);
    }
    abstract public function process(BankService $bankService): bool;

    public function getDetails(): array
    {
        return $this->details;
    }
}

class CreditCardPayment extends CardPayment
{
    public function process(BankService $bankService): bool
    {
        return $bankService->communicateWithBank($this->details);
    }
    public function getDetails(): array
    {
        return parent::getDetails() + ['type' => 'credit_card'];
    }
}
class DebitCardPayment extends CardPayment
{
    public function process(BankService $bankService): bool
    {
        return $bankService->communicateWithBank($this->details);
    }
    public function getDetails(): array
    {
        return parent::getDetails() + ['type' => 'debit_card'];
    }
}
class DigitalWalletPayment implements PaymentInterface
{
    private array $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }
    public function validate(): bool
    {
        return isset($this->details['wallet_id']) && isset($this->details['password']);
    }
    public function process(BankService $bankService): bool
    {
        return $bankService->communicateWithBank($this->details);
    }
    public function getDetails(): array
    {
        return $this->details;
    }
}


interface LoggerInterface
{
    public function log(array $data): void;
}
class FileLogger implements LoggerInterface
{
    public function log(array $data): void
    {
        file_put_contents('log.txt', json_encode($data) . PHP_EOL, FILE_APPEND);
    }
}
interface FraudDetectorInterface
{
    public function detect(array $transaction): bool;
}

class BasicFraudDetector implements FraudDetectorInterface
{
    public function detect(array $transaction): bool
    {
        $amount = $transaction['amount'] ?? 0;
        return $transaction['amount'] < 10000;
    }
}

interface ReportGeneratorInterface
{
    public function generate(array $transaction): string;
}
class JsonReportGenerator implements ReportGeneratorInterface
{
    public function generate(array $transaction): string
    {
        return json_encode($transaction, JSON_PRETTY_PRINT);
    }
}
class BankService
{
    public function communicateWithBank(array $details): bool
    {
        return !empty($details);
    }
}
class PaymentResponse
{
    public bool $success;
    public string $message;
    public ?string $report;
    public function __construct(bool $success, string $message, ?string $report = null)
    {
        $this->success = $success;
        $this->message = $message;
        $this->report = $report;
    }
}

class PaymentGateway
{
    private LoggerInterface $logger;
    private FraudDetectorInterface $fraudDetector;
    private ReportGeneratorInterface $reportGenerator;
    private BankService $bankService;
    public function __construct(LoggerInterface $logger, FraudDetectorInterface $fraudDetector, ReportGeneratorInterface $reportGenerator, BankService $bankService)
    {
        $this->logger = $logger;
        $this->fraudDetector = $fraudDetector;
        $this->reportGenerator = $reportGenerator;
        $this->bankService = $bankService;
    }
    public function processPayment(PaymentInterface $payment): PaymentResponse
    {
        $transaction = $payment->getDetails();
        if (!$payment->validate()) {
            return new PaymentResponse(false, 'Invalid payment details');
        }
        if (!$this->fraudDetector->detect($transaction)) {
            return new PaymentResponse(false, 'Fraud detected');
        }
        if (!$payment->process($this->bankService)) {
            return new PaymentResponse(false, 'Payment processing failed');
        }
        $response = new PaymentResponse(true, 'Payment processed successfully');
        $logData = $transaction + ['success' => $response->success, 'message' => $response->message];
        $this->logger->log($logData);
        return $response;
    }
}
$logger = new FileLogger();
$fraudDetector = new BasicFraudDetector();
$reportGenerator = new JsonReportGenerator();
$bankService = new BankService();
$gateway = new PaymentGateway($logger, $fraudDetector, $reportGenerator, $bankService);
$creditCardPayment = new CreditCardPayment(['card_number' => '1234567890123456', 'expiry' => '12/25', 'cvv' => '123', 'amount' => 1000]);
$result = $gateway->processPayment($creditCardPayment);
print_r([$result->success, $result->message, $result->report]);
