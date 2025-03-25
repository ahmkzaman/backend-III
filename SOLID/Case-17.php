<?php
interface NotificationInterface
{
    public function notificationName();
    public function sendNotification();
}
/**
 * NotificationProvider is a abstract class which implements NotificationInterface
 * It has a constructor which accepts credentials
 * It has a abstract method notificationName which returns the name of the notification
 */
abstract class NotificationProvider implements NotificationInterface
{

    protected $credentials;
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }
    abstract public function notificationName(): string;
    public function sendNotification()
    {
        return $this->notificationName() . " Sent to" . $this->credentials . PHP_EOL;
    }
}
class EmailNotification extends NotificationProvider
{

    public function notificationName(): string
    {
        return "Email Notification";
    }
}
class SMSNotification extends NotificationProvider
{


    public function notificationName(): string
    {
        return "SMS Notification";
    }
}

class PushNotification extends NotificationProvider
{

    public function notificationName(): string
    {
        return "Push Notification";
    }
}

class WebhookNotification implements NotificationInterface
{
    private $url;
    public function __construct($url)
    {
        $this->url = $url;
    }
    public function notificationName(): string
    {
        return "Webhook Notification";
    }
    public function sendNotification()
    {
        return $this->notificationName() . " Sent to" . $this->url . PHP_EOL;
    }
}

/**
 * NotificationSystem is a class which has a method processNotification which accepts NotificationInterface
 * It has a method processNotification which accepts NotificationInterface
 * It calls the sendNotification method of the NotificationInterface
 */
class NotificationSystem
{
    public function processNotification(NotificationInterface $notification)
    {
        echo $notification->sendNotification();
    }
}



$notification = new NotificationSystem();
$emailNotification = new EmailNotification("abc@gmail.com");
$smsNotification = new SMSNotification("1234567890");
$pushNotification = new PushNotification("User123 (Device ID)");
$webhookNotification = new WebhookNotification("https://webhook.site/3b3b3b3b-3a4b");
$notification->processNotification($emailNotification);
$notification->processNotification($smsNotification);
$notification->processNotification($pushNotification);
$notification->processNotification($webhookNotification);
