<?php

namespace App\Models;

use PDO;

class User extends \Core\Model
{
    public static function getAllUser()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function doLogin($username, $password, $remember = false){
        $db = static::getDB();
        $stmt = $db->prepare('SELECT id, username, password, role FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        if($stmt->rowCount() > 0){
            if(password_verify($password, $user['password'])){
                $_SESSION['admin_login'] = $user['id'];
                $_SESSION['admin_name'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getUser($user_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id'=>$user_id]);
        return $stmt->fetch();
    }

    public function getUserByName($username){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username'=>$username]);
        return $stmt->fetch();
    }

    public function change_password($data){
        $db = static::getDB();
        $stmt = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function getUsers($user_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id <> :id");
        $stmt->execute([':id'=>$user_id]);
        return $stmt->fetchAll();
    }
    public function InsertUser($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function checkUsername($username){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function deleteUser($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }
}
