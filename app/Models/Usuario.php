<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = true;

    protected $fillable = [
        'nombre_usuario',
        'correo',
        'contrasena',
        'id_rol'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
    
    public function productos()
{
    return $this->hasMany(Producto::class, 'id_usuario');
}

public function productosAsignados()
{
    return $this->hasMany(Producto::class, 'id_usuario_tecnico');
}

}
