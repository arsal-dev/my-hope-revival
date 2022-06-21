<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class ChatController {
    public function initiate_chat($request){
        $client_id = $request['id'];
        $chat_time = $request['time'];
        $username = $_SESSION['admin_name'];

        $user = new \App\Models\User();
        $user = $user->getUserByName($username);

        $chat_start_time = date("Y/m/d H:i:s", strtotime("now"));
        $chat_end_time = date("Y/m/d H:i:s", strtotime("+$chat_time minutes"));

        $data = [
            'client_id' => $client_id,
            'admin_id' => $user['id'],
            'accepted' => 1,
            'chat_start_time' => $chat_start_time,
            'chat_end_time' => $chat_end_time,
        ];

        $chat_req = new \App\Models\Chat();
        $chat_req_id = $chat_req->InitiateChatReq($data);

        $chat_start = new \App\Models\Chat();
        $chat_id = $chat_start->InitiateChat($chat_req_id);
    }
}