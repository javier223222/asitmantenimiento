<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Maintenance extends Model
{

    use HasUuids;
    protected $table="maintenance";
    protected $keyType = 'string';
    public function producto():HasOne
    {
        return $this->hasOne(Productmai::class);
    }
    
}
