<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class HomeController extends \Core\Controller
{
    public function index()
    {
        View::render('frontend/layouts/header.html', ['title' => 'Hope Revival - Let your hopes, not your hurts, shape your future', 'home' => 'active']);
        View::render('frontend/index.html');
        View::render('frontend/layouts/footer.html');
    }
    public function about()
    {
        View::render('frontend/layouts/header.html', ['title' => 'about Hope Revival', 'about' => 'active']);
        View::render('frontend/about.html');
        View::render('frontend/layouts/footer.html');
    }
    public function contact()
    {
        View::render('frontend/layouts/header.html', ['title' => 'contact Hope Revival', 'contact' => 'active']);
        View::render('frontend/contact.html');
        View::render('frontend/layouts/footer.html');
    }
    public function gallery()
    {
        View::render('frontend/layouts/header.html', ['title' => 'gallery Hope Revival', 'gallery' => 'active']);
        View::render('frontend/gallery.html');
        View::render('frontend/layouts/footer.html');
    }
    public function therapist()
    {
        View::render('frontend/layouts/header.html', ['title' => 'therapist Hope Revival', 'therapist' => 'active']);
        View::render('frontend/therapist.html');
        View::render('frontend/layouts/footer.html');
    }
}
