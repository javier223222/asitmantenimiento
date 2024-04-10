<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProducto extends Model
{
    use HasFactory;
    protected $table="img_product";
    protected $primaryKey="id_img_product";

    protected $fillable=[
        "id_img",
        "id_productMai",
    ];

    public function img(){
        return $this->belongsTo(Img::class,"id_img","id_img");
    }


}
