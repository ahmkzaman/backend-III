<?php

namespace LoggerApp\Loggers;;

interface LoggerInterface
{
    public function log(string $message, string $level): void;
}
