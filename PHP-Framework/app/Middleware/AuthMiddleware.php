<?php

namespace App\Middleware;

use Core\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {

            echo "Unautorized access";
            exit();
        }
    }
}
