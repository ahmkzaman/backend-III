<?php

namespace Core;

/**
 * Base Controller class for the application.
 * This class provides methods to handle requests and responses.
 */

abstract class Middleware
{
    /**
     * Handle the request before it reaches the controller.
     *
     * @param array $request The request data.
     * @return bool True if the request should proceed, false otherwise.
     */
    abstract public function handle(): void;
}
