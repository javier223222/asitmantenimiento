<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    protected $table="cliente";
    protected $primaryKey="id_cliente";
    protected $fillable=[
        "name",
        "last_name",
        "mother_last_name",
        "email",
        "telefono"

    ];

    public function equiposenmantenimiento (){
        return $this ->hasMany(Maintenance::class,"id_cliente","id_cliente");
    }

}
