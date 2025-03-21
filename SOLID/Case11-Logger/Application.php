<?php

namespace LoggerApp;

use LoggerApp\Loggers\LoggerInterface;

class Application
{
    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function doSomething(): void
    {
        $this->logger->log('user performed an action', 'INFO');
    }
    public function handleError(): void
    {
        $this->logger->log('an error occurred', 'ERROR');
    }
}
