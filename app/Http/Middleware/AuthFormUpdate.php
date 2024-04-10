<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthFormUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->input("exampleRadios") && !$request->file("newimage")){
            Session::flash("errorupdate","La actualiozacón no se pudo realizar, por favor seleccione una opción o una imagen nueva");
            return redirect()->back();

        }

        return $next($request);
    }
}
