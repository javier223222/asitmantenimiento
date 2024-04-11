<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Authclient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Session::has("client")) {
            return $next($request);
        } else if (Session::has("admin")) {
            return redirect()->route("admin");
        } else if (Session::has("superAdmin")) {
            return redirect()->route("superadmin");

        }

        return redirect()->route("principal");
    }
}
