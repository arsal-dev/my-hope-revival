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
$router->add('process', ['controller' => 'HomeController', 'action' => 'process']);
$router->add('set-session', ['controller' => 'SessionController', 'action' => 'setSession']);

// user auth
$router->add('signup', ['controller' => 'AuthController', 'action' => 'index']);
$router->add('signup-post', ['controller' => 'AuthController', 'action' => 'signup_post']);
$router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('login-post', ['controller' => 'AuthController', 'action' => 'login_post']);

// clientarea
$router->add('clientarea', ['controller' => 'ClientController', 'action' => 'index']);
$router->add('clientarea', ['controller' => 'ClientController', 'action' => 'index']);
$router->add('clientarea/logout', ['controller' => 'ClientController', 'action' => 'logout']);


// admin routes
$admin_dir = \App\Config::ADMIN_PATH;

$router->add($admin_dir, ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir. '/dashboard', ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir.'/login', ['controller' => 'LoginController', 'action' => 'login']);
$router->add($admin_dir.'/post-login', ['controller' => 'LoginController', 'action' => 'post_login']);
$router->add($admin_dir.'/logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add($admin_dir.'/gallery', ['controller' => 'AdminController', 'action' => 'gallery']);
$router->add($admin_dir.'/add-to-gallery', ['controller' => 'GalleryController', 'action' => 'add_gallery']);
$router->add($admin_dir.'/upload-image', ['controller' => 'GalleryController', 'action' => 'upload_image']);
$router->add($admin_dir.'/remove-image/{id:\d+}', ['controller' => 'GalleryController', 'action' => 'remove_image']);
$router->add($admin_dir.'/clients', ['controller' => 'AdminController', 'action' => 'clients']);
$router->add($admin_dir.'/initiate-chat/{id:\d+}/{time:\d+}', ['controller' => 'ChatController', 'action' => 'initiate_chat']);

$router->dispatch($_SERVER['QUERY_STRING']);
