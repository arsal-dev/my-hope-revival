<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class ClientController {
    public function __construct()
    {
        Auth('user');
    }
    public function index(){
        View::render('clientarea/layouts/header.html', ['title' => 'Cientarea Dashbaord', 'clientarea' => 'active']);
        View::render('clientarea/dashboard.html');
        View::render('clientarea/layouts/footer.html');
    }
    public function logout(){
        session_destroy();
        session_start();
        redirectWithMessage(app_url().'/login', 'Thank you for stopping by', 'login');
    }
}