<?php

namespace LoggerApp\Loggers;

class LoggerFactory
{
    public static function createLogger(string $type, array $config): LoggerInterface
    {
        switch (strtolower($type)) {
            case 'file':
                return new FileLogger($config['filePath']);
            case 'cloud':
                return new CloudLogger($config['apiKey']);
            default:
                throw new \InvalidArgumentException('Invalid logger type' . $type);
        }
    }
}
