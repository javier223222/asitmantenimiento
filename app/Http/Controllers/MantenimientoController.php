<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        return response()->json($mantenimientos);
    }

    public function store(Request $request)
    {
        $mantenimiento = Mantenimiento::create($request->all());
        return response()->json($mantenimiento, 201);
    }

    public function show($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        return response()->json($mantenimiento);
    }

    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());
        return response()->json($mantenimiento, 200);
    }

    public function destroy($id)
    {
        Mantenimiento::destroy($id);
        return response()->json(null, 204);
    }
}
