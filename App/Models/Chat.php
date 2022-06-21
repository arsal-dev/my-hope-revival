<?php

namespace App\Models;

use PDO;

class Chat extends \Core\Model
{
    public function InitiateChatReq($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO chat_req (client_id, admin_id, accepted, chat_start_time, chat_end_time) VALUES (:client_id, :admin_id, :accepted, :chat_start_time, :chat_end_time)");
        if($stmt->execute($data)){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }
    public function InitiateChat($req_id){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO chat (req_id) VALUES (:req_id)");
        if($stmt->execute($req_id)){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }
}