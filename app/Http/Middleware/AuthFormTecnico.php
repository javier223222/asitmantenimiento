<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthFormTecnico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $name=$request->input("name");
        $lastName=$request->input("last_name");
        $motherLastName=$request->input("mother_last_name");

        $username=$request->input("username");
        $password=$request->input("password");
        if($name && $lastName && $motherLastName && $username && $password){
            return $next($request);
        }
        Session::flash("erroform","Todos los campos son requeridos");
        return redirect()->back();


    }
}
