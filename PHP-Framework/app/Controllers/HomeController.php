<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): void
    {
        $user = new User();
        $allUsers = $user->all();
        // Render the home page view
        $this->view('home', [
            'users' => $allUsers,
        ]);
    }

    public function about(): void
    {
        // Render the about page view
        $this->view('about', [
            'title' => 'About Us'
        ]);
    }
}
