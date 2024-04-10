<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AutAllUsers
{
    /**
     * Handle an incoming request.
     *|
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Session::has("superAdmin")||Session::has("admin")||Session::has("client")){
            return $next($request);
        }
        return redirect()->route("principal");

    }
}
