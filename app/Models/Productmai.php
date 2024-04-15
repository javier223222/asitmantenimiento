<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Productmai extends Model
{
    use HasFactory;
    protected $table="productmai";
    protected $fillable=[
        "name",
        "id_category",
        "id_brand",
        "descripcion",

    ];

    public function category(){
        return $this->belongsTo(Category::class,"id_category","id_category");

    }
    public function brand(){
        return $this->belongsTo(Brand::class,"id_brand","id_brand");
    }

    public function imagePrduct(){
        return $this->hasMany(ImgProducto::class,"id_productMai","id_productMai");
    }


}
