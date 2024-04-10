<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthFormAddEquipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $inputimg=$request->file("fileproducto");
       $nameequipo=$request->input("nombreproducto");
       $descripcionequi=$request->input("descripcionequi");
       $descripcionproblema=$request->input("descripcionproblema");
       $marcaequipo=$request->input("marcaequipo");
       $categoria=$request->input("categoria");
       $nombrecliente=$request->input("nombrecliente");
       $apellidopcli=$request->input("apellidopcli");
       $apellidomcli=$request->input("apellidomcli");
       $emailclien=$request->input("emailclien");
       $telefonoclien=$request->input("telefonoclien");

       if(!$inputimg || !$nameequipo || !$descripcionequi || !$descripcionproblema || !$marcaequipo || $categoria==0 || !$nombrecliente || !$apellidopcli || !$apellidomcli || !$emailclien || !$telefonoclien){
         Session::flash("erroradprud","Todos los campos son requeridos");
          return redirect()->back();
        }
        return $next($request);
    }
}
