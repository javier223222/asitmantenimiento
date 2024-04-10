<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public function addCliente($name,$last_name,$mother_last_name,$email,$phone){

        $cliente=Cliente::create([
            "name"=>$name,
            "email"=>$email,
            "telefono"=>$phone,
            "last_name"=>$last_name,
            "mother_last_name"=>$mother_last_name,
        ]);
        return $cliente;

    }
    public function search($search)
    {
        $cliente = Cliente::where('name',$search);
        return $cliente;
    }
    public function index(){
      return view('clientes.home.index');
    }
    public function viewfolio()
    {
        return view('clientes.index');
    }

    public function searchMantenimiento(Request $request)
    {
        $numero=$request->input('numero');
        $folioid=$request->input('folio');

        $mantenimientos=Maintenance::whereHas("cliente",function($query) use($numero){
            $query->where("telefono",$numero);
        })->where("foliId",$folioid)->first();
        if($mantenimientos){
            $cliente=$mantenimientos->cliente;

            Session::put("client",$cliente);
            Session::put("mantenimientocliente",$mantenimientos);
            return redirect()->route("cliente");
        }

        Session::flash("errosearch","numero de folio o numero incorrecto");
        return redirect()->back();




    }
    public function salir(){
        Session::forget("client");
        Session::forget("mantenimientocliente");
        return redirect()->route("principal");
    }
    public function viewChat($id){
        return view('clientes.chat.index',["id"=>$id]);
    }
    
}
