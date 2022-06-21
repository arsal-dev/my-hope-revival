<?php

namespace App\Models;

use PDO;

class Client extends \Core\Model
{
    public static function getAllClients()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM clients');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertClient($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO clients (name, email, birthday, password) VALUES (:name, :email, :birthday, :password)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function getClientByEmail($email){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM clients WHERE email = :email");
        $stmt->execute([':email'=>$email]);
        return $stmt->fetchAll();
    }
}