<?php
//event entity
class Event
{

    private $id;
    private $name;
    private $totalSeats;
    private $availableSeats;
    private $ticketPrice;

    public function __construct(int $id, string $name, int $totalSeats, float $ticketPrice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
        $this->ticketPrice = $ticketPrice;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }
    public function getTicketPrice(): float
    {
        return $this->ticketPrice;
    }
    public function reserveSeats(int $numSeats): bool
    {
        return true;
    }
    public function releaseSeats(int $numSeats): void {}
}

//Event repository interface
interface EventRepositoryInterface
{
    public function getEventById(int $id): ?Event;
    public function findAll(): array;
    public function update(Event $event): void;
}
//Event repository class 
class  EventRepository implements EventRepositoryInterface
{
    private $events;
    public function __construct()
    {
        $this->events = [];
    }
    public function getEventById(int $id): ?Event
    {
        return null;
    }
    public function findAll(): array
    {
        return [];
    }
    public function update(Event $event): void {}
}

//Payment gateway interface
interface PaymentGateway
{
    public function processPayment(float $amount): bool;
    public function refundPayment(float $amount): bool;
}
//stripe payment gateway class
class StripePaymentGateway implements PaymentGateway
{
    public function processPayment(float $amount): bool
    {
        return true;
    }
    public function refundPayment(float $amount): bool
    {
        return true;
    }
}
// Notifier interface
interface Notifier
{
    public function sendNotification(string $message): void;
}
//Email notifier class
class EmailNotifier implements Notifier
{
    public function sendNotification(string $message): void
    {
        echo "Email sent: $message";
    }
}
//Reservation class
class ReservationService
{
    private $eventRepository;
    private $paymentGateway;
    private $notifier;
    public function __construct(EventRepositoryInterface $eventRepository, PaymentGateway $paymentGateway, Notifier $notifier)
    {
        $this->eventRepository = $eventRepository;
        $this->paymentGateway = $paymentGateway;
        $this->notifier = $notifier;
    }
    public function reserveSeats(int $eventId, int $numSeats, float $amount): array
    {
        return ['success' => true];
    }
    public function cancelSeats(int $eventId, int $numSeats, float $amount): array
    {
        return ['success' => true];
    }
}

//Even controller class
class EventController
{
    private $eventRepository;
    private $reservationService;
    public function __construct(EventRepositoryInterface $eventRepository, ReservationService $reservationService)
    {
        $this->eventRepository = $eventRepository;
        $this->reservationService = $reservationService;
    }
    public function listEvents(): string
    {
        return json_encode([]);
    }
    public function reserveSeats(int $eventId, int $numSeats, string $user): string
    {
        return json_encode(['success' => true]);
    }

    public function cancelSeats(int $eventId, int $numSeats, string $user): string
    {
        return json_encode(['success' => true]);
    }
}
