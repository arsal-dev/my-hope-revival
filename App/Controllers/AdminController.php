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
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - Gallery', 'gallery' => 'active']);
        View::render('backend/gallery.html');
        View::render('backend/layouts/footer.html');
    }
    public function add_gallery()
    {
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - Add to Gallery', 'gallery' => 'active']);
        View::render('backend/add-to-gallery.html');
        View::render('backend/layouts/footer.html');
    }
    public function upload_image()
    {
        $image = $_FILES['image'];
        $image_desc = $_POST['desc'];

        
    }
}