<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class AdminController {
    public function __construct()
    {
        Auth('admin');
    }
    public function index()
    {
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - Dashboard', 'dashboard' => 'active']);
        View::render('backend/dashboard.html');
        View::render('backend/layouts/footer.html');
    }
    public function gallery()
    {
        $gallery = new \App\Models\Gallery();
        $gallery = $gallery->getGallery();
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - Gallery', 'gallery' => 'active']);
        View::render('backend/gallery.html', ['gallery' => $gallery]);
        View::render('backend/layouts/footer.html');
    }
    public function clients()
    {
        $clients = new \App\Models\Client();
        $clients = $clients->getAllClients();
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - clients', 'clients' => 'active']);
        View::render('backend/clients.html', ['clients' => $clients]);
        View::render('backend/layouts/footer.html');
    }
}