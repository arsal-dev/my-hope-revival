<?php


namespace App\Controllers;

use App\Models\Account;
use Core\View;

class AuthController
{
    public function index()
    {
        View::render('frontend/layouts/header.html', ['title' => 'My Account', 'signup' => 'active']);
        View::render('frontend/auth/account.html');
        View::render('frontend/layouts/footer.html');
    }
    public function signup_post()
    {
        $name = clean_post('name');
        $email = clean_post('email');
        $date = clean_post('date');
        $password = clean_post('password');
        $cpassword = clean_post('cpassword');

        if(empty($name)){
            redirectWithMessage('signup', 'Please Enter Name', 'signup', 'error');
        }
        elseif(empty($email)){
            redirectWithMessage('signup', 'Please Enter Email', 'signup', 'error');
        }
        elseif(empty($date)){
            redirectWithMessage('signup', 'Please Enter Date', 'signup', 'error');
        }
        elseif(empty($password)){
            redirectWithMessage('signup', 'Please Enter Password', 'signup', 'error');
        }
        elseif(empty($cpassword)){
            redirectWithMessage('signup', 'Please Enter Confirm Password', 'signup', 'error');
        }
        elseif(strlen($password) < 8){
            redirectWithMessage('signup', 'Password Must Be Grater Or Less Then 8', 'signup', 'error');
        }
        else {
            if($password != $cpassword){
                redirectWithMessage('signup', 'Password and Confirm Password Do Not Match', 'signup', 'error');
            }
            else{
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $name = clean_post('name');
                $email = strtolower(clean_post('email'));
                $date = clean_post('date');
                $password = clean_post('password');
                $cpassword = clean_post('cpassword');
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'birthday' => $date,
                    'password' => $hash_password,
                ];

                // check if email exists
                $checkEmail = new \App\Models\Client();
                $check = $checkEmail->getClientByEmail($email);
                if(count($check) > 0){
                    redirectWithMessage('signup', 'This Email Already Exists Please <a href="login">Login</a> / <a href="forgot-password">Forgot Password?</a>', 'signup', 'error');
                }
                else {
                    // session_start();
                    $_SESSION['username'] = $name;
                    $_SESSION['email'] = $email;
                    $account = new \App\Models\Client();
                    $account->InsertClient($data);
                    redirect('clientarea');
                }
            }
        }
    }
    public function login()
    {
        View::render('frontend/layouts/header.html', ['title' => 'Login My Hope Revival', 'signup' => 'active']);
        View::render('frontend/auth/login.html');
        View::render('frontend/layouts/footer.html');
    }
    public function login_post()
    {
        $email = strtolower(clean_post('email'));
        $password = clean_post('password');

        if(empty($email)){
            redirectWithMessage('login', 'Please Enter Email', 'login', 'error');
        }
        elseif(empty($password)){
            redirectWithMessage('login', 'Please Enter Password', 'login', 'error');
        }
        else {
            $checkEmail = new \App\Models\Client();
            $check = $checkEmail->getClientByEmail($email);
            if(count($check) > 0){
                $db_pass = $check[0]['password'];
                if(password_verify($password, $db_pass)){
                    $_SESSION['username'] = $check[0]['name'];
                    $_SESSION['email'] = $email;
                    redirect('clientarea');
                }
                else {
                    redirectWithMessage('login', 'Your Email / Password is wrong!', 'login', 'error');
                }
            }
            else {
                redirectWithMessage('login', 'Your Email / Password is wrong!', 'login', 'error');
            }
        }
    }
}