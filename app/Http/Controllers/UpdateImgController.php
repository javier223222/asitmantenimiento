<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class UpdateImgController extends Controller
{
   public function updateImg($file){

         $inputimg=$file;
         $obj=Cloudinary::upload($inputimg->getRealPath(),["folder"=>"equipos"]);
         $public_id = $obj->getPublicId();
         $url = $obj->getSecurePath();
         return [
                "public_id"=>$public_id,
                "url"=>$url

         ];

   }
}
