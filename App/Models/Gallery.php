<?php


namespace App\Models;
use PDO;

class Gallery extends \Core\Model
{
    public function getGallery(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM gallery");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertGallery($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO gallery 
                                (image, image_desc)
                                VALUES 
                                (:image, :image_desc)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function DeleteGalleryContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM gallery WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }
}