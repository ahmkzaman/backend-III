<?php
/*
    * Simple PHP Framework
    * This file serves as the entry point for the application.
    * It initializes the router and dispatches requests to the appropriate controllers.
    * @package SimplePHPFramework
    * @version 1.0.0
*/


declare(strict_types=1); // declare strict types for better type safety

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Middleware.php';
require_once __DIR__ . '/../routes/web.php';

use Core\Router;

$url = $_GET['url'] ?? '/'; // Default to root if no URL is provided
$router = new Router(); // Create a new Router instance
$router->dispatch($url);// Dispatch the request to the appropriate controller and method
