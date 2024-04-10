<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'categoria_id',
        'id_usuario',
        'id_usuario_tecnico',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_tecnico');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'id_producto');
    }
}
