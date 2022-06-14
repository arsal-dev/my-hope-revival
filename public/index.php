<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes ---- public routes
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('about', ['controller' => 'HomeController', 'action' => 'about']);
$router->add('contact', ['controller' => 'HomeController', 'action' => 'contact']);
$router->add('gallery', ['controller' => 'HomeController', 'action' => 'gallery']);
$router->add('therapist', ['controller' => 'HomeController', 'action' => 'therapist']);

// admin routes
$admin_dir = \App\Config::ADMIN_PATH;

$router->add($admin_dir, ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir. '/dashboard', ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir.'/login', ['controller' => 'LoginController', 'action' => 'login']);
$router->add($admin_dir.'/post-login', ['controller' => 'LoginController', 'action' => 'post_login']);
$router->add($admin_dir.'/logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add($admin_dir.'/gallery', ['controller' => 'AdminController', 'action' => 'gallery']);
$router->add($admin_dir.'/add-to-gallery', ['controller' => 'AdminController', 'action' => 'add_gallery']);
$router->add($admin_dir.'/upload-image', ['controller' => 'AdminController', 'action' => 'upload_image']);

$router->dispatch($_SERVER['QUERY_STRING']);
