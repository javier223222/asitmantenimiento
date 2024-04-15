<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Maintenance extends Model
{


    protected $table="maintenance";
    protected $keyType = 'string';
    protected $primaryKey = 'foliId';


    protected $fillable=[
        "foliId",
        "id_productMai",
        "id_cliente",
        "status",
        "is_finish",
        "descripcionproblema",
        "id_admin",

    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,"id_cliente","id_cliente");
    }

    public function product(){
        return $this->belongsTo(Productmai::class,"id_productMai","id_productMai");
    }
    public function admin(){
        return $this->belongsTo(Admin::class,"id_admin","id");
    }


}
