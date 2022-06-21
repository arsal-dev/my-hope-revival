<?php

namespace App\Controllers;

use App\Models\Leads;
use \Core\View;
use PDO;

class GalleryController {
    public function add_gallery()
    {
        View::render('backend/layouts/header.html', ['title' => 'Hope Revival - Add to Gallery', 'gallery' => 'active']);
        View::render('backend/add-to-gallery.html');
        View::render('backend/layouts/footer.html');
    }
    public function upload_image()
    {
        $image_desc = $_POST['image-desc'];
        $path = "gallery";
        $file_name = uploadfile('image', $path, 5);

        $data = [
            'image' => $file_name,
            'image_desc' => $image_desc
        ];
        $gl = new \App\Models\Gallery();
        $gl->InsertGallery($data);
        redirectWithMessage(app_url('admin').'/gallery', 'Image Added Successfully', 'gallery');
    }
    public function remove_image($request){
        $gal = new \App\Models\Gallery();
        $gals= $gal->DeleteGalleryContent($request['id']);
        if($gals){
            redirectWithMessage(app_url('admin').'/gallery', 'Image Deleted Successfully', 'gallery');
        }else{
            redirectWithMessage(app_url('admin').'/gallery', 'Unable to delete Gallery information please contact developers', 'faqs', 'error');
        }
    }
}