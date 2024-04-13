<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    use HasFactory;
    protected $table="chat";
    protected $fillable=[
        "id",
        "id_cliente",
        "foliId",
        "message",

    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class,"id_cliente","id_cliente");
    }
    public function admin(){
        return $this->belongsTo(Admin::class,"id","id");
    }
    

}
