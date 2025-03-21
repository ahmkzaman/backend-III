<?php

namespace LoggerApp\Loggers;

/**
 * FileLogger class
 */

class FileLogger implements LoggerInterface
{
    private $filePath;
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }
    public function log(string $message, string $level): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$level] $message" . PHP_EOL;
        file_put_contents($this->filePath, $logEntry, FILE_APPEND);
    }
}
