<?php

namespace App\Http\Controllers;

use App\Models\Productmai;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function AddProducto($name,$idcategoria,$idBrand,$description){
        $producto=Productmai::create([
            "name"=>$name,
            "id_category"=>$idcategoria,
            "id_brand"=>$idBrand,
            "descripcion"=>$description
        ]);
        return $producto;

    }
}
