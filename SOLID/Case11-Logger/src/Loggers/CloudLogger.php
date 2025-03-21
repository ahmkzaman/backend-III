<?php

namespace LoggerApp\Loggers;

class CloudLogger implements LoggerInterface
{
    private string $apiKey;
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function log(string $message, string $level): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$level]$message";
        echo "Sending to cloud $logEntry(API Key: $this->apiKey\n";
    }
}
