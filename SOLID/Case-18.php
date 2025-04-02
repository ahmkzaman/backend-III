<?php
interface NotificationStrategy
{
    public function sendNotification(string $message): string;
}


class EmailNotification implements NotificationStrategy
{

    public function sendNotification(string $message): string
    {
        return "Sending Email notification: $message";
    }
}

class SMSNotification implements NotificationStrategy
{

    public function sendNotification(string $message): string
    {
        return "Sending SMS notification: $message";
    }
}

class NotificationService
{
    private NotificationStrategy $notification;
    public function __construct(NotificationStrategy $notification)
    {
        $this->notification = $notification;
    }
    public function send(string $message): void
    {
        echo $this->notification->sendNotification($message) . PHP_EOL;
    }
}

// Usage
$emailNotification = new EmailNotification();
$smsNotification = new SMSNotification();
$notificationService = new NotificationService($emailNotification);
$notificationService->send("Test notification!");
$notificationService = new NotificationService($smsNotification);
$notificationService->send("Test notification!");
