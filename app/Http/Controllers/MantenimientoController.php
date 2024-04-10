<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function update(){
        return view('admin.normaladmin.equipo.updateequipo.index');
    }
}
