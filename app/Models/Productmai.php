<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Productmai extends Model
{
    use HasFactory;
    protected $table="productmai";
    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function brands():BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }
}
