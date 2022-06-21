<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class SessionController extends \Core\Controller
{
    public function setSession()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // session_start();
        $_SESSION['selection'] = $data['selection'];
        $_SESSION['sessionType'] = $data['sessionType'];
        $_SESSION['therapy'] = $data['therapy'];
        $_SESSION['sessionPrice'] = $data['sessionPrice'];

        if(isset($_SESSION['name'])){
            echo json_encode(['code' => 202]);
        }
        else {
            echo json_encode(['code' => 200]);
        }
    }
}