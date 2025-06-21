<?php

namespace Core;

/**
 * Base Controller class for the application.
 * This class provides methods to handle requests and responses.
 */

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        // Extract data to variables for use in the view
        extract($data);

        // Include the view file
        require __DIR__ . '/..app/views/' . $view . '.php';
    }
}
